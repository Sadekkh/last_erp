<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('adminlayouts.category', compact('data'));
    }

    // Show the form for creating a new garage.
    public function create()
    {
        return view('adminlayouts.category');
    }

    // Store a newly created garage in the database.
    public function store(Request $request)
    {
        $data = new Category([

            'name_ar' => $request->input('name_ar'),
            'name_en' => $request->input('name_en'),

        ]);
        $data->save();



        return redirect(route('category.index'))->with('success', 'created successfully.');
    }


    public function edit($id)
    {
        $data = Category::findOrFail($id);

        return response()->json($data);
    }

    // Update the specified garage in the database.
    public function update(Request $request, $id)
    {
        $validatedData = $request->all();
        $data = Category::findOrFail($id);

        $data->update($validatedData);

        return redirect(route('Category.index'))->with('success', 'updated successfully.');
    }

    // Remove the specified garage from the database.
    public function destroy($id)
    {
        $data = Category::findOrfail($id);
        $data->delete();

        return redirect(route('Category.index'))->with('success', 'deleted successfully.');
    }
}
