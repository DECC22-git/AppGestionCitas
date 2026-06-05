<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Diagnóstico</title>
    @vite(['resources/css/create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('diagnostic.index') }}" class="btn-back">← Volver</a>
            <h2>Modificar Diagnóstico</h2>
        </div>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('diagnostic.update', $diagnostic->id) }}" method="POST">
            @csrf 
            @method('PUT')

            <div class="form-group">
                <label>Fecha y Hora de Emisión</label>
                <input type="datetime-local" name="date" value="{{ date('Y-m-d\TH:i', strtotime($diagnostic->date)) }}" required>
            </div>

            <div class="form-group">
                <label>Cita Asociada</label>
                <select name="appointment_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($appointments as $appointment)
                        <option value="{{ $appointment->id }}" {{ $diagnostic->appointment_id == $appointment->id ? 'selected' : '' }}>
                            Cita #{{ $appointment->id }} - {{ $appointment->patient->first_name }} con Dr. {{ $appointment->doctor->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Paciente</label>
                <select name="patient_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $diagnostic->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Médico Evaluador</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $diagnostic->doctor_id == $doctor->id ? 'selected' : '' }}>
                            Dr(a). {{ $doctor->first_name }} {{ $doctor->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tipo de Diagnóstico</label>
                <input type="text" name="diagnostic_type" value="{{ $diagnostic->diagnostic_type }}" required>
            </div>

            <div class="form-group">
                <label>Severidad</label>
                <select name="severity" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="observation" {{ $diagnostic->severity == 'observation' ? 'selected' : '' }}>Observación</option>
                    <option value="mild" {{ $diagnostic->severity == 'mild' ? 'selected' : '' }}>Leve</option>
                    <option value="moderate" {{ $diagnostic->severity == 'moderate' ? 'selected' : '' }}>Moderado</option>
                    <option value="severe" {{ $diagnostic->severity == 'severe' ? 'selected' : '' }}>Severo</option>
                </select>
            </div>

            <div class="form-group">
                <label>Descripción del Diagnóstico</label>
                <textarea name="description" rows="3" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-family: inherit;">{{ $diagnostic->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Recomendaciones / Indicaciones</label>
                <textarea name="recommendations" rows="3" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-family: inherit;">{{ $diagnostic->recommendations }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Actualizar Diagnóstico</button>
        </form>
    </div>
</body>
</html>