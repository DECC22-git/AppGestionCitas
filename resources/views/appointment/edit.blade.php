<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita Médica</title>
     @vite(['resources/css/create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('appointment.index') }}" class="btn-back">← Volver</a>
            <h2>Modificar Cita Médica</h2>
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

        <form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
            @csrf 
            @method('PUT')

            <div class="form-group">
                <label>Fecha y Hora de la Cita</label>
                <input type="datetime-local" name="date" value="{{ date('Y-m-d\TH:i', strtotime($appointment->date)) }}" required>
            </div>

            <div class="form-group">
                <label>Paciente</label>
                <select name="patient_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Médico Especialista</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                            Dr(a). {{ $doctor->first_name }} {{ $doctor->last_name }} ({{ $doctor->specialty }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Consultorio / Ambiente</label>
                <input type="text" name="room" value="{{ $appointment->room }}" required>
            </div>

            <div class="form-group">
                <label>Motivo de la Cita</label>
                <input type="text" name="reason" value="{{ $appointment->reason }}" required>
            </div>

            <div class="form-group">
                <label>Observaciones Adicionales</label>
                <textarea name="observations" rows="3" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-family: inherit;">{{ $appointment->observations }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Actualizar Cita</button>
        </form>
    </div>
</body>
</html>