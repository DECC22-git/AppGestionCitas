<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $doctors = Doctor::when($search, function ($query, $search) {
            return $query->where('speciality', 'LIKE', "%{$search}%")
                        ->orWhere('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%");
        })->get();

        return view('doctor.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctor.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'license' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'years_of_experience' => 'required|integer|min:0',
        ]);
        
        Doctor::create($validated);

        return redirect()->route('doctor.index')->with('success', 'Médico registrado correctamente.');
    }

    // Route Model Binding para Doctor
    public function edit(Doctor $doctor)
    {
        return view('doctor.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'license' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'years_of_experience' => 'required|integer|min:0',
        ]);

        $doctor->update($validated);

        return redirect()->route('doctor.index')->with('success', 'Médico actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctor.index')->with('success', 'El médico ha sido eliminado correctamente.');
    }
}