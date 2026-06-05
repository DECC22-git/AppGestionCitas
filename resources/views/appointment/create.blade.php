<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    @vite(['resources/css/create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('appointment.index') }}" class="btn-back">← Volver</a>
            <h2>Nueva Cita Médica</h2>
        </div>

        <form action="{{ route('appointment.store') }}" method="POST">
            @csrf 
            
            <div class="form-group">
                <label>Fecha y Hora de la Cita</label>
                <input type="datetime-local" name="date" required>
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
                <label>Médico Especialista</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="">-- Seleccione un Médico --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">Dr(a). {{ $doctor->first_name }} {{ $doctor->last_name }} ({{ $doctor->specialty }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Consultorio / Ambiente</label>
                <input type="text" name="room" placeholder="Ej. Consultorio 302, Piso 3" required>
            </div>

            <div class="form-group">
                <label>Motivo de la Cita</label>
                <input type="text" name="reason" placeholder="Ej. Control mensual, Chequeo general" required>
            </div>

            <div class="form-group">
                <label>Observaciones Adicionales</label>
                <textarea name="observations" rows="3" placeholder="Ej. El paciente debe venir en ayunas..." style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-family: inherit;"></textarea>
            </div>

            <button type="submit" class="btn-submit">Programar Cita</button>
            
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