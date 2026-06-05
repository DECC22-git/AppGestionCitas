<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Tratamiento</title>
    @vite(['resources/css/create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('treatment.index') }}" class="btn-back">← Volver</a>
            <h2>Nuevo Tratamiento Médico</h2>
        </div>

        <form action="{{ route('treatment.store') }}" method="POST">
            @csrf 
            
            <div class="form-group">
                <label>Nombre del Tratamiento / Medicamento</label>
                <input type="text" name="name" placeholder="Ej. Amoxicilina 500mg, Terapia Física" required>
            </div>

            <div class="form-group">
                <label>Diagnóstico Vinculado</label>
                <select name="diagnostic_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="">-- Seleccione el Diagnóstico --</option>
                    @foreach($diagnostics as $diagnostic)
                        <option value="{{ $diagnostic->id }}">
                            Diag. #{{ $diagnostic->id }} - {{ $diagnostic->diagnostic_type }} (Paciente: {{ $diagnostic->patient->first_name }})
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
                <label>Médico Prescriptor</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="">-- Seleccione un Médico --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">Dr(a). {{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Frecuencia de Administración</label>
                <input type="text" name="administration_frequency" placeholder="Ej. Cada 8 horas, Una vez al día" required>
            </div>

            <div class="form-group">
                <label>Duración Total</label>
                <input type="text" name="duration" placeholder="Ej. 7 días, 3 semanas" required>
            </div>

            <div class="form-group">
                <label>Estado Inicial</label>
                <select name="status" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="pending">Pendiente (Pending)</option>
                    <option value="ongoing">En Curso (Ongoing)</option>
                    <option value="completed">Completado (Completed)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Descripción / Instrucciones Detalladas</label>
                <textarea name="description" rows="3" placeholder="Tomar después de los alimentos, disolver en agua, etc..." required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-family: inherit;"></textarea>
            </div>

            <button type="submit" class="btn-submit">Guardar Tratamiento</button>
            
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