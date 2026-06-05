<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Buscamos cargando las relaciones de paciente y doctor
        $appointments = Appointment::with(['patient', 'doctor'])
            ->when($search, function ($query, $search) {
                return $query->where('reason', 'LIKE', "%{$search}%")
                             ->orWhere('room', 'LIKE', "%{$search}%")
                             ->orWhereHas('patient', function ($q) use ($search) {
                                 $q->where('first_name', 'LIKE', "%{$search}%")
                                   ->orWhere('last_name', 'LIKE', "%{$search}%");
                             })
                             ->orWhereHas('doctor', function ($q) use ($search) {
                                 $q->where('first_name', 'LIKE', "%{$search}%")
                                   ->orWhere('last_name', 'LIKE', "%{$search}%");
                             });
            })->get();

        return view('appointment.index', compact('appointments'));
    }

    public function create()
    {
        // Necesitamos listar pacientes y doctores para los select del formulario
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointment.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'reason' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'observations' => 'nullable|string',
            'room' => 'required|string|max:255',
        ]);
        
        Appointment::create($validated);

        return redirect()->route('appointment.index')->with('success', 'Cita programada correctamente.');
    }

    // Route Model Binding para Appointment
    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointment.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'reason' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'observations' => 'nullable|string',
            'room' => 'required|string|max:255',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointment.index')->with('success', 'Cita actualizada con éxito.');
    }

    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointment.index')->with('success', 'La cita ha sido cancelada y eliminada.');
    }
}