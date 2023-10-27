<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Models\MaintenanceOrder;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\Models\Stock;
use App\Models\StockedItem;
use App\Models\StockTransaction;
use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();
        // Calculate the date one week from now
        $oneWeekFromNow = $currentDate->subWeek();

        $mai = MaintenanceOrder::where('status', '!=', 'completed')->whereBetween('entry_time', [$oneWeekFromNow, $currentDate])->count();
        $mai1 = MaintenanceOrder::where('status', 'completed')->whereBetween('entry_time', [$oneWeekFromNow, $currentDate])->count();
        $outsider = MaintenanceOrder::where('source', 'outsider')->whereBetween('entry_time', [$oneWeekFromNow, $currentDate])->count();
        $req = ModelsRequest::whereBetween('date', [$oneWeekFromNow, $currentDate])->count();
        $request = ModelsRequest::with('totalQuantity', 'totalitems')->orderBy('date', 'desc')->limit(10)->get();
        // Retrieve trucks with "next_check" within one week
        $truck = Truck::where('next_check', '>', $oneWeekFromNow)->get();
        $garage = Garage::all();
        $mainf = MaintenanceOrder::where('status', 'completed')->whereBetween('entry_time', [$oneWeekFromNow, $currentDate])->get();
        $maing = MaintenanceOrder::where('status', '!=', 'completed')->whereBetween('entry_time', [$oneWeekFromNow, $currentDate])->get();


        return view('pages.index', compact('mainf', 'maing', 'garage', 'mai', 'mai1', 'outsider', 'req', 'request', 'truck', 'currentDate', 'oneWeekFromNow'));
    }
    public function indexwith_time(Request $request)
    {
        $currentDate = $request->input('startdate');
        $oneWeekFromNow = $request->input('enddate');
        $mai = MaintenanceOrder::where('status', '!=', 'completed')->whereBetween('entry_time', [$currentDate, $oneWeekFromNow])->count();
        $mai1 = MaintenanceOrder::where('status', 'completed')->whereBetween('entry_time', [$currentDate, $oneWeekFromNow])->count();
        $outsider = MaintenanceOrder::where('source', 'outsider')->whereBetween('entry_time', [$currentDate, $oneWeekFromNow])->count();
        $req = ModelsRequest::whereBetween('date', [$currentDate, $oneWeekFromNow])->count();
        $request = ModelsRequest::with('totalQuantity', 'totalitems')->orderBy('date', 'desc')->limit(10)->get();

        $garage = Garage::all();

        // Retrieve trucks with "next_check" within one week
        $truck = Truck::where('next_check', '>', $oneWeekFromNow)->limit(10)->get();

        $mainf = MaintenanceOrder::where('status', 'completed')->whereBetween('entry_time', [$currentDate, $oneWeekFromNow])->get();
        $maing = MaintenanceOrder::where('status', '!=', 'completed')->whereBetween('entry_time', [$currentDate, $oneWeekFromNow])->get();


        return view('pages.index', compact('mainf', 'maing', 'garage', 'mai', 'mai1', 'outsider', 'req', 'request', 'truck', 'currentDate', 'oneWeekFromNow'));
    }
    public function all_prod()
    {
        $data = Product::with('productdetail', 'stockedquantity', 'media')->where('type', 'product')->get();
        return view('print.allprod', compact('data'));
    }
    public function all_service()
    {
        $data = Product::with('servicedetail')->where('type', 'service')->get();
        return view('print.allservice', compact('data'));
    }
    public function all_stocked_items()
    {
        $data = StockedItem::with('product', 'stock')->get();
        return view('print.allstockeditem', compact('data'));
    }
    public function all_requests(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        $data = ModelsRequest::with('garage', 'totalQuantity', 'totalitems')->whereBetween('date', [$start, $end])->get();
        return view('print.allrequests', compact('data', 'start', 'end'));
    }
    public function transaction(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        $data = StockTransaction::with('garage', 'workshop', 'maintenanceOrder', 'worker', 'stockEmployee', 'stocked_item')->whereBetween('created_at', [$start, $end])->get();
        return view('print.transaction', compact('data', 'start', 'end'));
    }
    public function bought_items(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $data = StockedItem::with('product', 'stock.garage', 'stock.request')->whereHas('stock', function ($query) use ($start, $end) {
            $query->whereBetween('purchase_date', [$start, $end]);
        })->get();

        return view('print.boughtitems', compact('data', 'start', 'end'));
    }
    public function bought_items_garage(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $id = $request->input('id');
        $data = StockedItem::with('product', 'stock.garage', 'stock.request')->whereHas('stock', function ($query) use ($start, $end, $id) {
            $query->where('garage_id', $id)->whereBetween('purchase_date', [$start, $end]);
        })->get();
        return view('print.boughtitems', compact('data', 'start', 'end'));
    }
    public function maintenance(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $id = $request->input('id');

        $data = MaintenanceOrder::with('truck', 'trailer', 'driver', 'workshop', 'mainteancetask.product', 'mainteancetask.replaceditem.olditem', 'mainteancetask.replaceditem.newitem', 'mainteancetask.replaceditem.product')->findOrfail($id);
        return view('print.maintenance', compact('data', 'start', 'end'));
    }
}
