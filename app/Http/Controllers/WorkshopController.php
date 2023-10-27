<?php

namespace App\Http\Controllers;

use App\Models\Damaged_product;
use App\Models\Driver;
use App\Models\MaintenanceOrder;
use App\Models\MaintenanceTask;
use App\Models\Media;
use App\Models\Product;
use App\Models\ReplacedProduct;
use App\Models\StockedItem;
use App\Models\StockTransaction;
use App\Models\Truck;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WorkshopController extends Controller
{
    public function entryorexit()
    {
        $trucks  = Truck::where('type', 'truck')->get();
        $trailer = Truck::where('type', 'trailer')->get();
        $driver = Driver::all();
        return view('pages.workshop', compact('trucks', 'trailer', 'driver'));
    }

    public function store(Request $request)
    {

        if ($request->filled('model')) {
            $truck = Truck::create([
                'model' => $request->input('model'),
                'year' => $request->input('year'),
                'number_wheels' => $request->input('number_wheels'),
                'oil_change' => $request->input('oil_change'),
                'vin' => $request->input('vin'),
                'entry_time' => $request->input('entry_time'),
                'mileage' => $request->input('mileage'),
                'type' => 'truck',
                'source' => 'outsider',
            ]);
            $truck->save();
        }
        if ($request->filled('model1')) {
            $trailer = Truck::create([
                'model' => $request->input('model1'),
                'number_wheels' => $request->input('number_wheels1'),
                'year' => $request->input('year1'),
                'oil_change' => $request->input('oil_change1'),
                'vin' => $request->input('vin1'),
                'entry_time' => $request->input('entry_time1'),
                'mileage' => $request->input('mileage1'),
                'type' => 'trailer',

                'source' => 'outsider',
            ]);
            $trailer->save();
        }
        if ($request->filled('cin')) {
            $driver = Driver::create([
                'cin' => $request->input('cin'),
                'name_ar' => $request->input('name_ar'),
                'name_en' => $request->input('name_en'),
                'phone' => $request->input('phone'),

            ]);
            $driver->save();
        }

        $data = MaintenanceOrder::create([
            'truck_id' => !empty($truck) ? $truck->id : $request->input('truck_id'),
            'truck_trailer_id' => !empty($trailer) ? $trailer->id : $request->input('truck_trailer_id'),
            'driver_id' => !empty($driver) ? $driver->id :  $request->input('driver_id'),
            'workshop_id' => $request->input('workshop_id'),
            'entry_time' => $request->input('entry_time'),
            'complain' => $request->input('complain'),
            'reason' => $request->input('reason'),
            'source' => $request->input('source'),
            'entry_state' => $request->input('entry_state'),
            'workshop_id' => Auth::user()->workshop_id,
            'approximate_leaving_time' => $request->input('approximate_leaving_time'),

        ]);
        $data->save();

        $up = MaintenanceOrder::findOrfail($data->id);
        $up->code = '#' . $up->workshop_id . '-' . $up->id;
        $up->save();
        return redirect()->back()->with('success', 'created successfully');
    }
    public function getMaintenanceOrderCode()
    {
        $data[0] = MaintenanceOrder::pluck('code');
        $data[1] = Product::where('type',  'service')->get();
        $data[2] = worker::where('product_id', '1')->where('workshop_id', Auth::user()->workshop_id)->get();
        return response()->json($data);
    }
    public function fetch_data(Request $request)
    {
        $code = $request->input('code');
        $data[0] = MaintenanceOrder::with('truck', 'trailer', 'driver', 'workshop')->where('code', $code)->get();
        $data[1] = MaintenanceTask::with('product', 'worker', 'replaceditem', 'replaceditem.olditem', 'replaceditem.newitem')->where('maintenance_order_id', $data[0][0]->id)->get();
        return response()->json($data);
    }
    public function fetch_photo(Request $request)
    {
        $code = $request->input('code');
        $data = MaintenanceOrder::where('code', $code)->get();
        $dat = Media::where('entity_type', 'maintenance')->where('entity_id', $data[0]->id)->get();
        return response()->json($dat);
    }
    public function printing($id)
    {
        $data = MaintenanceOrder::with('truck', 'trailer', 'driver', 'workshop', 'mainteancetask.product')->findOrfail($id);
        $datas = [
            "type" => 'maintenanceOrder',
            "code" => $data->code,
            "id" => $data->id
        ];
        // Encode the data as JSON
        $jsonData = json_encode($datas);
        $qr = QrCode::size(100)->generate($jsonData);

        return view('components.print', compact('data', 'qr'));
    }
    public function update_maintenance(Request $request)
    {
        $code = $request->input('code');
        $data = MaintenanceOrder::where('code', $code)->get();
        $truck = Truck::findOrfail($data[0]->truck_id);
        $trailer = Truck::findOrfail($data[0]->truck_trailer_id);
        $truck->update(['mileage' => $request->input('mileage2'), 'next_check' => $request->input('next_check')]);
        $trailer->update(['next_check' => $request->input('next_check')]);
        $dat = MaintenanceOrder::findOrfail($data[0]->id);
        $dat->update($request->all());
        if (filled('leaving_time')) {
            $dat->status = 'completed';
            $dat->save();
            $truck->last_check = $request->input('leaving_time');
            $truck->save();
        }

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $timestamp = now()->getTimestampMs();

                $uniqueFileName = $timestamp . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products/'), $uniqueFileName);
                Media::insert([
                    'file_name' => $uniqueFileName,
                    'entity_id' => $data[0]->id,
                    'entity_type' => 'maintenance',

                ]);
            }
        }
        return response()->json(['success' => 'success'], 200);
    }
    public function savejob(Request $request)
    {
        MaintenanceTask::create($request->all());
        return response()->json(['success' => 'success'], 200);
    }
    public function get_worker($id)
    {
        $data = Worker::where('product_id', $id)->get();
        return response()->json($data);
    }
    public function editservicetask($id)
    {
        $data = MaintenanceTask::with('product', 'replaceditem')->find($id);
        $worker = Worker::where('product_id', $data->product_id)->get();
        $new = StockedItem::with('product')->get();
        $old = StockedItem::with('product')->get();
        return view('pages.editservicetask', compact('data', 'worker', 'new', 'old'));
    }
    public function updatetask(Request $request, $id)
    {

        $data = MaintenanceTask::find($id);
        $data->update($request->all());
        if (filled($request->leaving_time)) {
            $data->status = 'completed';
        } else {
            $data->status = 'in_progress';
        }
        $data->save();

        return redirect()->back()->with('success', 'created successfully.');
    }
    public function save_changed_items(Request $request)
    {

        $t = MaintenanceTask::with('maintenanceOrder')->find($request->input('maintenance_task_id'));
        if (filled($request->input('wheel_position'))) {
            if ($request->input('wheel_position') > 10) {
                $truck = $t->maintenanceOrder->truck_trailer_id;
            } else {
                $truck = $t->maintenanceOrder->truck_id;
            }
            $data = ReplacedProduct::create($request->all() + ["truck_id" => $truck]);
            $data->save();
            if ($request->input('old_prod_desc') == "damaged") {
                Damaged_product::create($request->all() + ['stock_item_id' => $request->input('old_item_id'), "maintenance_order_id" => $t->maintenance_order_id, "driver_id" => $t->maintenanceOrder->driver_id]);
                $prod = StockedItem::where('id', $request->input('old_item_id'))->first();
                if ($prod) {
                    $prod->state = "damaged";
                    $prod->save();
                }
            }
        } else if (filled($request->input('oil_amount'))) {
            if ($request->input('for') == "trailer") {
                $truck = $t->maintenanceOrder->truck_trailer_id;
            } else {
                $truck = $t->maintenanceOrder->truck_id;
            }
            $data = ReplacedProduct::create($request->all() + ["truck_id" => $truck, "old_prod_desc" => "damaged"]);
        } else {
            if ($request->input('for') == "trailer") {
                $truck = $t->maintenanceOrder->truck_trailer_id;
            } else {
                $truck = $t->maintenanceOrder->truck_id;
            }
            $data = ReplacedProduct::create($request->all() + ["truck_id" => $truck]);
            if ($request->input('old_prod_desc') == "damaged") {
                Damaged_product::create($request->all() + ['stock_item_id' => $request->input('old_item_id'), "maintenance_order_id" => $t->maintenance_order_id, "driver_id" => $t->maintenanceOrder->driver_id]);
                $prod = StockedItem::where('id', $request->input('old_item_id'))->first();
                if ($prod) {
                    $prod->state = "damaged";
                    $prod->save();
                }
            }
        }


        return redirect()->back()->with('success', 'created successfully.');
    }
}
