<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tratamiento</title>
    @vite(['resources/css/create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('treatment.index') }}" class="btn-back">← Volver</a>
            <h2>Modificar Tratamiento</h2>
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

        <form action="{{ route('treatment.update', $treatment->id) }}" method="POST">
            @csrf 
            @method('PUT')

            <div class="form-group">
                <label>Nombre del Tratamiento / Medicamento</label>
                <input type="text" name="name" value="{{ $treatment->name }}" required>
            </div>

            <div class="form-group">
                <label>Diagnóstico Vinculado</label>
                <select name="diagnostic_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($diagnostics as $diagnostic)
                        <option value="{{ $diagnostic->id }}" {{ $treatment->diagnostic_id == $diagnostic->id ? 'selected' : '' }}>
                            Diag. #{{ $diagnostic->id }} - {{ $diagnostic->diagnostic_type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Paciente</label>
                <select name="patient_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $treatment->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Médico Prescriptor</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $treatment->doctor_id == $doctor->id ? 'selected' : '' }}>
                            Dr(a). {{ $doctor->first_name }} {{ $doctor->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Frecuencia de Administración</label>
                <input type="text" name="administration_frequency" value="{{ $treatment->administration_frequency }}" required>
            </div>

            <div class="form-group">
                <label>Duración Total</label>
                <input type="text" name="duration" value="{{ $treatment->duration }}" required>
            </div>

            <div class="form-group">
                <label>Estado</label>
                <select name="status" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="pending" {{ $treatment->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                    <option value="ongoing" {{ $treatment->status == 'ongoing' ? 'selected' : '' }}>En Curso</option>
                    <option value="completed" {{ $treatment->status == 'completed' ? 'selected' : '' }}>Completado</option>
                </select>
            </div>

            <div class="form-group">
                <label>Descripción / Instrucciones Detalladas</label>
                <textarea name="description" rows="3" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-family: inherit;">{{ $treatment->description }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Actualizar Tratamiento</button>
        </form>
    </div>
</body>
</html>