<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Diagnóstico</title>
    @vite(['resources/css/create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('diagnostic.index') }}" class="btn-back">← Volver</a>
            <h2>Nuevo Diagnóstico</h2>
        </div>

        <form action="{{ route('diagnostic.store') }}" method="POST">
            @csrf 
            
            <div class="form-group">
                <label>Fecha y Hora de Emisión</label>
                <input type="datetime-local" name="date" required>
            </div>

            <div class="form-group">
                <label>Cita Asociada</label>
                <select name="appointment_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="">-- Seleccione la Cita --</option>
                    @foreach($appointments as $appointment)
                        <option value="{{ $appointment->id }}">
                            Cita #{{ $appointment->id }} - {{ $appointment->patient->first_name }} con Dr. {{ $appointment->doctor->last_name }} ({{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Paciente</label>
                <select name="patient_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="">-- Seleccione un Paciente --</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Médico Evaluador</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="">-- Seleccione un Médico --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">Dr(a). {{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tipo de Diagnóstico</label>
                <input type="text" name="diagnostic_type" placeholder="Ej. Clínico, Presuntivo, Por Imágenes" required>
            </div>

            <div class="form-group">
                <label>Severidad</label>
                <select name="severity" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="observation">Observación</option>
                    <option value="mild">Leve (Mild)</option>
                    <option value="moderate">Moderado (Moderate)</option>
                    <option value="severe">Severo (Severe)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Descripción del Diagnóstico</label>
                <textarea name="description" rows="3" placeholder="Detalle los hallazgos médicos..." required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-family: inherit;"></textarea>
            </div>

            <div class="form-group">
                <label>Recomendaciones / Indicaciones</label>
                <textarea name="recommendations" rows="3" placeholder="Reposo, evitar comidas grasas, etc..." style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-family: inherit;"></textarea>
            </div>

            <button type="submit" class="btn-submit">Guardar Diagnóstico</button>
            
            @if ($errors->any())
                <div class="alert-danger" style="color: red; margin-top: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</body>
</html>