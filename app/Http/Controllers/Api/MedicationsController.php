<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medication;
use App\Models\Treatment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Diagnostic;

class MedicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $medications = Medication::with(['treatment', 'doctor', 'patient', 'diagnostic'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('Provider', 'LIKE', "%{$search}%")
                             ->orWhereHas('patient', function ($q) use ($search) {
                                 $q->where('first_name', 'LIKE', "%{$search}%")
                                   ->orWhere('last_name', 'LIKE', "%{$search}%");
                             });
            })->get();

        return view('medication.index', compact('medications'));
    }

    public function create()
    {
        $treatments = Treatment::all();
        $doctors = Doctor::all();
        $patients = Patient::all();
        $diagnostics = Diagnostic::all();

        return view('medication.create', compact('treatments', 'doctors', 'patients', 'diagnostics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'treatment_id' => 'required|exists:treatments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'diagnostic_id' => 'required|exists:diagnostics,id',
            'Provider' => 'required|string|max:255',
            'secundary_effects' => 'nullable|string|max:255',
        ]);

        Medication::create($validated);

        return redirect()->route('medication.index')->with('success', 'Medicamento registrado con éxito.');
    }

    // Route Model Binding para Medication
    public function edit(Medication $medication)
    {
        $treatments = Treatment::all();
        $doctors = Doctor::all();
        $patients = Patient::all();
        $diagnostics = Diagnostic::all();

        return view('medication.edit', compact('medication', 'treatments', 'doctors', 'patients', 'diagnostics'));
    }

    public function update(Request $request, Medication $medication)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'treatment_id' => 'required|exists:treatments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'diagnostic_id' => 'required|exists:diagnostics,id',
            'Provider' => 'required|string|max:255',
            'secundary_effects' => 'nullable|string|max:255',
        ]);

        $medication->update($validated);

        return redirect()->route('medication.index')->with('success', 'Medicamento actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        $medication = Medication::findOrFail($id);
        $medication->delete();

        return redirect()->route('medication.index')->with('success', 'Medicamento eliminado correctamente.');
    }
}