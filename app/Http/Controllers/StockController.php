<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Garage;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\Models\RequestedItem;
use App\Models\Stock;
use App\Models\StockedItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StockController extends Controller
{
    public function index()
    {
        $data = Stock::with('product', 'garage', 'brand', 'supplier', 'stockedquantity')->get();
        return view('pages.allstock', compact('data'));
    }
    public function create($id)
    {
        $supplier = Supplier::all();
        $brand = Brand::all();
        $data = RequestedItem::with('product.productdetail')->findOrfail($id);

        return view('pages.addstock', compact('data', 'supplier', 'brand'));
    }
    public function edit($id)
    {
        $supplier = Supplier::all();
        $brand = Brand::all();
        $data = Stock::with('stockeditem')->find($id);

        return view('pages.editstock', compact('data', 'supplier', 'brand'));
    }
    public function show()
    {
        $data = StockedItem::with('product', 'stock')->get();
        return view('pages.allitems', compact('data'));
    }
    public function update(Request $request, $id)
    {

        $data = Stock::find($id);
        $data->update($request->all());
        return redirect()->route('allstock')->with('success', 'created successfully.');
    }
    public function savestock(Request $request, $id)
    {
        $d = RequestedItem::with('request')->find($id);

        $serialNumbers  = $request->input('serial_number');
        $stock = Stock::create($request->all() + ['product_id' => $d->product_id, 'request_id' => $d->request_id, 'garage_id' => $d->request->garage_id]);
        $stock->save();
        foreach ($serialNumbers as $serialNumber) {
            StockedItem::create([
                'product_id' => $d->product_id,
                'stock_id' => $stock->id,
                'serial_num' => $serialNumber,
                'unit_storage' => $request->input('unit_storage')
            ]);
        }
        $d->state = 'done';
        $d->save();

        return redirect()->back();
    }
    public function generateQRCode($id)
    {
        try {
            // Find the product by its ID
            $product = StockedItem::with('stock', 'product.productdetail')->findOrFail($id);
            $data = [
                "type" => 'product',
                "productname" => $product->product->name_en,
                "id" => $product->id,
                "unit" => $product->product->productdetail[0]->unit
            ];

            // Encode the data as JSON
            $jsonData = json_encode($data);
            // Generate a QR code with product information
            $datas = QrCode::size(200)->generate($jsonData);

            return response()->json(array(
                'qrcode' => strval($datas),
                'product' => $product,
            ));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error generating QR code: ' . $e->getMessage()], 500);
        }
    }
}
