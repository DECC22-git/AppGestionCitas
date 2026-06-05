<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'reason',
        'patient_id',
        'doctor_id',
        'observations',
        'room',
    ];

    // Relación con el Paciente
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relación con el Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}