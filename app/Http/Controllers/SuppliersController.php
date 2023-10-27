<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    // Display a listing of the suppliers.
    public function index()
    {
        $data = Supplier::all();
        return view('adminlayouts.supplier', compact('data'));
    }

    // Show the form for creating a new supplier.


    // Store a newly created supplier in the database.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_name_ar' => 'required|string',
            'supplier_name_en' => 'required|string',
            'phone' => 'nullable|string',
            'address_ar' => 'nullable|string',
            'address_en' => 'nullable|string',
        ]);

        Supplier::create($validatedData);

        return redirect(route('supplier.index'))->with('success', 'created successfully.');
    }


    // Show the form for editing the specified supplier.
    public function edit($id)
    {
        $data = Supplier::findOrFail($id);

        return response()->json($data);
    }

    // Update the specified supplier in the database.
    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'supplier_name_ar' => 'required|string',
            'supplier_name_en' => 'required|string',
            'phone' => 'nullable|string',
            'address_ar' => 'nullable|string',
            'address_en' => 'nullable|string',
        ]);

        $supplier->update($validatedData);

        return redirect(route('supplier.index'))->with('success', 'updated successfully.');
    }

    // Remove the specified supplier from the database.
    public function destroy($id)
    {
        $data = Supplier::findOrfail($id);
        $data->delete();

        return redirect(route('supplier.index'))->with('success', 'deleted successfully.');
    }
}
