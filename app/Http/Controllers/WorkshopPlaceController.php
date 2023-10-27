<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopPlaceController extends Controller
{
    public function index()
    {
        $data = Workshop::all();
        return view('adminlayouts.Workshop', compact('data'));
    }

    // Show the form for creating a new garage.
    public function create()
    {
        return view('adminlayouts.Workshop');
    }

    // Store a newly created garage in the database.
    public function store(Request $request)
    {
        $data = new Workshop([

            'name_ar' => $request->input('name_ar'),
            'name_en' => $request->input('name_en'),
            'address_ar' => $request->input('address_ar'),
            'address_en' => $request->input('address_en'),

        ]);
        $data->save();



        return redirect(route('workshop.index'))->with('success', 'created successfully.');
    }


    public function edit($id)
    {
        $data = Workshop::findOrFail($id);

        return response()->json($data);
    }

    // Update the specified garage in the database.
    public function update(Request $request, $id)
    {
        $validatedData = $request->all();
        $data = Workshop::findOrFail($id);

        $data->update($validatedData);

        return redirect(route('workshop.index'))->with('success', 'updated successfully.');
    }

    // Remove the specified garage from the database.
    public function destroy($id)
    {
        $data = Workshop::findOrfail($id);
        $data->delete();

        return redirect(route('workshop.index'))->with('success', 'deleted successfully.');
    }
}
