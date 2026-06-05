<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diagnostic;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;

class DiagnosticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $diagnostics = Diagnostic::with(['appointment', 'doctor', 'patient'])
            ->when($search, function ($query, $search) {
                return $query->where('diagnostic_type', 'LIKE', "%{$search}%")
                             ->orWhere('severity', 'LIKE', "%{$search}%")
                             ->orWhereHas('patient', function ($q) use ($search) {
                                 $q->where('first_name', 'LIKE', "%{$search}%")
                                   ->orWhere('last_name', 'LIKE', "%{$search}%");
                             });
            })->get();

        return view('diagnostic.index', compact('diagnostics'));
    }

    public function create()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        $doctors = Doctor::all();
        $patients = Patient::all();
        
        return view('diagnostic.create', compact('appointments', 'doctors', 'patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'date' => 'required|date',
            'appointment_id' => 'required|exists:appointments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'severity' => 'required|in:observation,mild,moderate,severe',
            'recommendations' => 'nullable|string',
            'diagnostic_type' => 'required|string|max:255',
        ]);

        Diagnostic::create($validated);

        return redirect()->route('diagnostic.index')->with('success', 'Diagnóstico registrado correctamente.');
    }

    // Route Model Binding para Diagnostic
    public function edit(Diagnostic $diagnostic)
    {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        $doctors = Doctor::all();
        $patients = Patient::all();

        return view('diagnostic.edit', compact('diagnostic', 'appointments', 'doctors', 'patients'));
    }

    public function update(Request $request, Diagnostic $diagnostic)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'date' => 'required|date',
            'appointment_id' => 'required|exists:appointments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'severity' => 'required|in:observation,mild,moderate,severe',
            'recommendations' => 'nullable|string',
            'diagnostic_type' => 'required|string|max:255',
        ]);

        $diagnostic->update($validated);

        return redirect()->route('diagnostic.index')->with('success', 'Diagnóstico actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        $diagnostic = Diagnostic::findOrFail($id);
        $diagnostic->delete();

        return redirect()->route('diagnostic.index')->with('success', 'Diagnóstico eliminado correctamente.');
    }
}