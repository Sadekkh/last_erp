<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Garage;
use App\Models\MaintenanceOrder;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Request as ModelsRequest;
use App\Models\RequestedItem;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\StockedItem;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{

    public function index()
    {
        $data = ModelsRequest::with('garage', 'totalQuantity', 'totalitems')->get();
        return view('pages.allrequest', compact('data'));
    }
    public function transaction()
    {

        $worker = Worker::all();

        return view('pages.stocktransaction', compact('worker'));
    }
    public function alltransaction()
    {

        $data = StockTransaction::with('maintenanceOrder', 'worker', 'stockEmployee', 'stocked_item', 'truck')->get();
        return view('pages.alltransaction', compact('data'));
    }
    public function deletetransaction($id)
    {

        $data = StockTransaction::find($id);
        $tra = StockedItem::find($data->stocked_item_id);
        $tra->unit_left += $data->quantity_taken;
        $tra->state = "available";
        $tra->save();
        $data->delete();
        return redirect()->back()->with('success', 'created successfully');
    }
    public function add_stock_item(Request $request)
    {

        $d = MaintenanceOrder::find($request->input('maintenance_orders_id'));
        if ($request->input('for') == "trailer") {
            $truck = $d->truck_trailer_id;
        } else {
            $truck = $d->truck_id;
        }
        $g = Worker::find($request->input('worker_id'));
        $data = StockTransaction::create($request->all() + ['truck_id' => $truck, "stock_employee_id" => Auth::user()->id, 'garage_id' => Auth::user()->garage_id, 'workshop_id' => $g->garage_id]);
        $data->save();
        $stock = StockedItem::findOrfail($data->stocked_item_id);
        $stock->unit_left -= $data->quantity_taken;
        $stock->save();
        if ($stock->unit_left == 0) {
            $stock->state = "unavailable";
            $stock->save();
        }
        return redirect()->back()->with('success', 'created successfully');
    }
    public function create()
    {
        $deal = Deal::all();
        $req = ModelsRequest::where('garage_id', Auth::user()->garage_id)->where('state', 'in_build')->get();
        $product = Product::where('type', 'product')->get();
        $supplier = Supplier::all();
        $settings = Setting::all();
        $garage = Garage::findOrfail(Auth::user()->garage_id);
        return view('pages.addrequest', compact('deal', 'req', 'product', 'supplier', 'settings', 'garage'));
    }
    public function edit_request($id)
    {
        $deal = Deal::all();
        $supplier = Supplier::all();
        $data = ModelsRequest::with('requested_item', 'requested_item.product', 'requested_item.supplier')->findOrfail($id);
        return view('pages.editrequest', compact('data', 'deal', 'supplier'));
    }
    public function printrequest($id)
    {
        $data = ModelsRequest::with('requested_item', 'requested_item.product', 'requested_item.supplier')->findOrfail($id);
        return view('pages.editrequest', compact('data', 'deal', 'supplier'));
    }
    public function getprodhistory($id)
    {
        $data = Stock::with('supplier')->where('product_id', $id)->orderBy('purchase_date', 'desc')->limit(20)->get();

        return response()->json($data);
    }
    public function restriction($id)
    {
        $supplier = Supplier::all();

        $data = ModelsRequest::with('requested_item', 'requested_item.product', 'requested_item.supplier')->findOrfail($id);
        $req = StockedItem::with('product', 'stock.garage')->whereHas('stock', function ($query) use ($id) {
            $query->where('request_id', $id);
        })->get();
        return view('pages.restriction', compact('data', 'req', 'supplier'));
    }
    public function confirmrequest($id)
    {
        $data = ModelsRequest::find($id);
        $data->state = 'p_section_manager';
        $data->save();
        return response()->json($data);
    }
    public function editrequestitem($id)
    {
        $data = RequestedItem::findOrfail($id);

        return response()->json($data);
    }
    public function saverequest(Request $request)
    {
        $d = ModelsRequest::where('garage_id', Auth::user()->garage_id)->where('date', $request->input('date'))->get();
        if ($d->isEmpty()) {
            $data = ModelsRequest::create($request->all() + ["garage_id" => Auth::user()->garage_id]);
            $data->save();
            $up = ModelsRequest::findOrfail($data->id);
            $up->code = '#' . $up->garage_id . '-' . $up->id;
            $up->save();
            return redirect()->back()->with('success', 'created successfully');
        } else {
            return redirect()->back()->with('error', 'something wrong');
        }
    }
    public function add_req_item(Request $request)
    {
        $data = RequestedItem::create($request->all());
        $data->save();
        $dat = RequestedItem::with('product', 'product.productdetail', 'supplier')->findOrfail($data->id);

        return response()->json($dat);
    }
    public function update_reques(Request $request, $id)
    {
        $data = RequestedItem::findOrfail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'created successfully');
    }
    public function update_request(Request $request, $id)
    {
        $data = ModelsRequest::findOrfail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'created successfully');
    }
    public function getrequestlist($id)
    {
        $dat = RequestedItem::with('product', 'product.productdetail', 'supplier')->where('request_id', $id)->get();
        return response()->json($dat);
    }
    public function suggestedprice($id, $prod)
    {
        $dat[0] = Stock::where('supplier_id', $id)->where('product_id', $prod)->orderBy('purchase_date', 'desc')->limit(20)->get();
        $dat[1] = ProductDetail::where('product_id', $prod)->get();
        return response()->json($dat);
    }
}
