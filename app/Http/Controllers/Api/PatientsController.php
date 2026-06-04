<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::when($search, function ($query, $search) {
            return $query->where('type_blood', 'LIKE', "%{$search}%")
                        ->orWhere('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%");
        })->get();
        return view('patients.index', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firt_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'blood_type'=>'nullable|string',
        ]);
        Patient::create($validated);

        return redirect()->route('patient.index')->with('success', 'Paciente registrado correctamente.');
    }

    public function edit(Patient $patients)
    {
        
        return view('patient.edit', compact('patient'));
    }
    public function update(Request $request, Patient $patients)
    {
        $validated = $request->validate([
            'firt_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'blood_type'=>'nullable|string',
        ]);
        $patients->update($validated);

        return redirect()->route('patient.index')->with('success', 'Paciente actualizado con éxito.');
    }
    public function destroy(string $id)
    {
        $patients = Patient::findOrFail($id);

       
        $patients->delete();

        return redirect()->route('patient.index')->with('success', 'El paciente ha sido eliminado correctamente.');
    }
}
