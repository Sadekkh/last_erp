<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class AllController extends Controller
{
    public function index()
    {
        $data = Setting::all();
        return view('adminlayouts.Setting', compact('data'));
    }

    // Show the form for creating a new garage.
    public function create()
    {
        return view('adminlayouts.Setting');
    }




    public function edit($id)
    {
        $data = Setting::findOrFail($id);

        return response()->json($data);
    }

    // Update the specified garage in the database.
    public function update(Request $request, $id)
    {
        $validatedData = $request->all();
        $data = Setting::findOrFail($id);

        $data->update($validatedData);

        return redirect(route('Setting.index'))->with('success', 'updated successfully.');
    }

    // Remove the specified garage from the database.
    public function destroy($id)
    {
        $data = Setting::findOrfail($id);
        $data->delete();

        return redirect(route('Setting.index'))->with('success', 'deleted successfully.');
    }
}
