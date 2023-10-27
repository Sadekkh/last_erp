<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    // Display a listing of the Trucks.
    public function index()
    {
        $data = Truck::all();
        return view('adminlayouts.truck', compact('data'));
    }

    // Show the form for creating a new Truck.
    public function create()
    {
        return view('Trucks.create');
    }

    // Store a newly created Truck in the database.
    public function store(Request $request)
    {

        $garage = new Truck([
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'number_wheels' => $request->input('number_wheels'),
            'oil_change' => $request->input('oil_change'),
            'vin' => $request->input('vin'),
            'mileage' => $request->input('mileage'),
            'type' => $request->input('type'),

        ]);
        $garage->save();


        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $timestamp = now()->getTimestampMs();

                // Create a unique filename using the timestamp
                $uniqueFileName = $timestamp . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products/'), $uniqueFileName);
                Media::insert([
                    'file_name' => $uniqueFileName,
                    'entity_id' => $garage->id,
                    'entity_type' => 'Truck',

                ]);
            }
        }
        return redirect(route('vehicle.index'))->with('success', 'Truck created successfully.');
    }

    // Display the specified Truck.
    public function show(Truck $Truck)
    {
        return view('Trucks.show', compact('Truck'));
    }

    // Show the form for editing the specified Truck.
    public function edit($id)
    {


        $data = Truck::findOrFail($id);
        $images = Media::where('entity_id', $id)->where('entity_type', 'Truck')->get();
        return view('adminlayouts.truckedit', compact('data', 'images'));
    }

    // Update the specified Truck in the database.
    public function update(Request $request, $id)
    {
        $validatedData = $request->all();
        $data = Truck::findOrFail($id);

        $data->update($validatedData);
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $timestamp = now()->getTimestampMs();

                $uniqueFileName = $timestamp . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products/'), $uniqueFileName);
                Media::insert([
                    'file_name' => $uniqueFileName,
                    'entity_id' => $id,
                    'entity_type' => 'Truck',

                ]);
            }
        }
        return redirect(route('vehicle.index'))->with('success', 'Truck updated successfully.');
    }

    // Remove the specified Truck from the database.
    public function destroy(Truck $Truck)
    {
        $Truck->delete();

        return redirect(route('vehicle.index'))->with('success', 'Truck deleted successfully.');
    }
}
