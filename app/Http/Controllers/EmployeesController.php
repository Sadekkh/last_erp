<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Models\ServiceDetail;
use App\Models\Worker;
use App\Models\Workshop;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    // Display a listing of the Workers.
    public function index()
    {
        $work = Workshop::all();
        $service = ServiceDetail::with('product')->get();
        $data = Worker::all();
        return view('adminlayouts.work', compact('data', 'work', 'service'));
    }

    // Show the form for creating a new Worker.
    public function create()
    {
        return view('Worker.create');
    }

    // Store a newly created Worker in the database.
    public function store(Request $request)
    {
        $validatedData = $request->all();

        Worker::create($validatedData);

        return redirect(route('employee.index'))->with('success', 'Worker created successfully.');
    }

    // Display the specified Worker.
    public function show(Worker $Worker)
    {
        return view('employee.show', compact('Worker'));
    }

    // Show the form for editing the specified Worker.
    public function edit($id)
    {
        $data = Worker::findOrfail($id);
        return response()->json($data);
    }

    // Update the specified Worker in the database.
    public function update(Request $request, Worker $Worker)
    {
        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'phone' => 'required|string',
            'cin' => 'required|string|unique:Worker,cin,' . $Worker->id,
            'service_id' => 'required|exists:services,id',
            'garage_id' => 'required|exists:garage,id',
        ]);

        $Worker->update($validatedData);

        return redirect(route('employee.index'))->with('success', 'Worker updated successfully.');
    }

    // Remove the specified Worker from the database.
    public function destroy($id)
    {
        $work = Worker::findOrfail($id);

        $work->delete();

        return redirect(route('employee.index'))->with('success', 'Worker deleted successfully.');
    }
}
