<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    // Display a listing of the drivers.
    public function index()
    {
        $data = Driver::all();
        return view('adminlayouts.driver', compact('data'));
    }

    // Show the form for creating a new driver.
    public function create()
    {
        return view('drivers.create');
    }

    // Store a newly created driver in the database.
    public function store(Request $request)
    {
        $validatedData = $request->all();

        Driver::create($validatedData);

        return redirect(route('driver.index'))->with('success', 'created successfully.');
    }

    // Display the specified driver.
    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    // Show the form for editing the specified driver.
    public function edit($id)
    {
        $data = Driver::findOrfail($id);
        return response()->json($data);
    }

    // Update the specified driver in the database.
    public function update(Request $request, Driver $driver)
    {
        $validatedData = $request->validate([
            'cin' => 'required|string|unique:drivers,cin,' . $driver->id,
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'phone' => 'required|string',
        ]);

        $driver->update($validatedData);

        return redirect(route('driver.index'))->with('success', 'updated successfully.');
    }

    // Remove the specified driver from the database.
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect(route('driver.index'))->with('success', 'deleted successfully.');
    }
}
