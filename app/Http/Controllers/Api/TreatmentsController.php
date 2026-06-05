<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\Diagnostic;
use App\Models\Doctor;
use App\Models\Patient;

class TreatmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $treatments = Treatment::with(['diagnostic', 'doctor', 'patient'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('status', 'LIKE', "%{$search}%")
                             ->orWhereHas('patient', function ($q) use ($search) {
                                 $q->where('first_name', 'LIKE', "%{$search}%")
                                   ->orWhere('last_name', 'LIKE', "%{$search}%");
                             });
            })->get();

        return view('treatment.index', compact('treatments'));
    }

    public function create()
    {
        $diagnostics = Diagnostic::with('patient')->get();
        $doctors = Doctor::all();
        $patients = Patient::all();

        return view('treatment.create', compact('diagnostics', 'doctors', 'patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string|max:255',
            'diagnostic_id' => 'required|exists:diagnostics,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'status' => 'required|in:pending,ongoing,completed',
            'administration_frequency' => 'required|string|max:255',
        ]);

        Treatment::create($validated);

        return redirect()->route('treatment.index')->with('success', 'Tratamiento asignado correctamente.');
    }

    // Route Model Binding para Treatment
    public function edit(Treatment $treatment)
    {
        $diagnostics = Diagnostic::with('patient')->get();
        $doctors = Doctor::all();
        $patients = Patient::all();

        return view('treatment.edit', compact('treatment', 'diagnostics', 'doctors', 'patients'));
    }

    public function update(Request $request, Treatment $treatment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string|max:255',
            'diagnostic_id' => 'required|exists:diagnostics,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'status' => 'required|in:pending,ongoing,completed',
            'administration_frequency' => 'required|string|max:255',
        ]);

        $treatment->update($validated);

        return redirect()->route('treatment.index')->with('success', 'Tratamiento actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->delete();

        return redirect()->route('treatment.index')->with('success', 'Tratamiento eliminado correctamente.');
    }
}