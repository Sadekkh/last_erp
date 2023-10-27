<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $data = Brand::all();
        return view('adminlayouts.Brand', compact('data'));
    }



    // Store a newly created garage in the database.
    public function store(Request $request)
    {
        $data = new Brand([

            'name_ar' => $request->input('name_ar'),
            'name_en' => $request->input('name_en'),

        ]);
        $data->save();



        return redirect(route('brand.index'))->with('success', 'created successfully.');
    }


    public function edit($id)
    {
        $data = Brand::findOrFail($id);

        return response()->json($data);
    }

    // Update the specified garage in the database.
    public function update(Request $request, $id)
    {
        $validatedData = $request->all();
        $data = Brand::findOrFail($id);

        $data->update($validatedData);

        return redirect(route('brand.index'))->with('success', 'updated successfully.');
    }

    // Remove the specified garage from the database.
    public function destroy($id)
    {
        $data = Brand::findOrfail($id);
        $data->delete();

        return redirect(route('brand.index'))->with('success', 'deleted successfully.');
    }
}
