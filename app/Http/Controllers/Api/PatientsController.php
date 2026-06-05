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

        // Aquí guardas los datos en la variable $patients (en PLURAL)
        $patients = Patient::when($search, function ($query, $search) {
            return $query->where('blood_type', 'LIKE', "%{$search}%")
                        ->orWhere('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%");
        })->get();

        // CORRECCIÓN 1: Pasamos 'patients' en plural para que la tabla index lo reconozca
        return view('patient.index', compact('patients'));
    }

    public function create()
    {
        return view('patient.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
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

    // CORRECCIÓN 2: Cambiamos el parámetro a $patient (SINGULAR) para que Laravel haga Route Model Binding con 'patient'
    public function edit(Patient $patient)
    {
        // CORRECCIÓN 3: Pasamos 'patient' en singular (coincidiendo con la variable de arriba)
        return view('patient.edit', compact('patient'));
    }

    // CORRECCIÓN 4: Cambiamos el parámetro a $patient (SINGULAR)
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'blood_type'=>'nullable|string',
        ]);

        // Usamos la variable corregida
        $patient->update($validated);

        return redirect()->route('patient.index')->with('success', 'Paciente actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patient.index')->with('success', 'El paciente ha sido eliminado correctamente.');
    }
}