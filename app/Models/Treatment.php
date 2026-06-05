<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'diagnostic_id',
        'doctor_id',
        'patient_id',
        'status',
        'administration_frequency',
    ];

    // Relación con el Diagnóstico
    public function diagnostic()
    {
        return $this->belongsTo(Diagnostic::class);
    }

    // Relación con el Médico
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Relación con el Paciente
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}