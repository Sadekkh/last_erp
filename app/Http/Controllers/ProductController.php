<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Garage;
use App\Models\MaintenanceOrder;
use App\Models\MaintenanceTask;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ServiceDetail;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::with('productdetail', 'stock', 'servicedetail')->get();


        return view('pages.allproduct', compact('data'));
    }
    public function add_product()
    {

        $category = Category::all();


        return view('pages.addproduct', compact('category',));
    }
    public function edit_prod($id)
    {
        $data = Product::with('servicedetail', 'productdetail', 'stock',)->findOrfail($id);
        $images = Media::where('entity_id', $id)->where('entity_type', 'product')->get();
        $category = Category::all();


        return view('pages.editprod', compact('data', 'category', 'images'));
    }

    public function productStore(Request $request)
    {

        $order = Product::create([

            'category_id' => $request->input('category_id'),
            'name_ar' => $request->input('name_ar'),
            'name_en' => $request->input('name_en'),
            'description_ar' => $request->input('description_ar'),
            'description_en' => $request->input('description_en'),
            'type' => $request->input('type'),

        ]);
        $order->save();
        if ($order->type == 'product') {
            ProductDetail::create($request->all() + ["product_id" => $order->id, "unit" => $request->input('prod_unit')]);
        }
        if ($order->type == 'service') {
            ServiceDetail::create($request->all() + ["product_id" => $order->id, "unit" => $request->input('job_unit')]);
        }
        $up = Product::findOrfail($order->id);
        $up->code = '#' . $up->category_id . '-' . $up->id;
        $up->save();
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $timestamp = now()->getTimestampMs();

                $uniqueFileName = $timestamp . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products/'), $uniqueFileName);
                Media::insert([
                    'file_name' => $uniqueFileName,
                    'entity_id' => $order->id,
                    'entity_type' => 'product',
                ]);
            }
        }
        return redirect()->back()->with('success', 'created successfully');
    }
    public function updateprod(Request $request, $id)
    {
        $data = Product::find($id);
        $data->update($request->all());
        $data->save();

        if ($data->type == "service") {
            $d = ServiceDetail::where('product_id', $id)->first();
            $d->update($request->all());
        } elseif ($data->type == "product") {
            $d = ProductDetail::where('product_id', $id)->first();
            $d->update($request->all());
        }
        $d->save();
        return redirect()->back()->with('success', 'created successfully');
    }
}
