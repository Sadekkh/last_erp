<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;

class GarageController extends Controller
{
    // Display a listing of the garages.
    public function index()
    {
        $data = Garage::all();
        return view('adminlayouts.garage', compact('data'));
    }

    // Show the form for creating a new garage.
    public function create()
    {
        return view('garages.create');
    }

    // Store a newly created garage in the database.
    public function store(Request $request)
    {
        $validatedData = $request->all();

        Garage::create($validatedData);

        return redirect(route('garage.index'))->with('success', 'created successfully.');
    }

    // Display the specified garage.
    public function show(Garage $garage)
    {
        return view('garages.show', compact('garage'));
    }

    // Show the form for editing the specified garage.
    public function edit($id)
    {
        $garage = Garage::findOrFail($id);

        return response()->json($garage);
    }

    // Update the specified garage in the database.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'number' => 'required|string',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'address_ar' => 'required|string',
            'address_en' => 'required|string',
            'rows' => 'required|string',
            'columns' => 'required|string',
        ]);
        $garage = Garage::findOrFail($id);

        $garage->update($validatedData);

        return redirect(route('garages.index'))->with('success', 'updated successfully.');
    }

    // Remove the specified garage from the database.
    public function destroy(Garage $garage)
    {
        $garage->delete();

        return redirect(route('garage.index'))->with('success', 'deleted successfully.');
    }
}
