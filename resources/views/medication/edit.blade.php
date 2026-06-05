<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medicamento</title>
    @vite(['resources/css/create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('medication.index') }}" class="btn-back">← Volver</a>
            <h2>Modificar Medicamento</h2>
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

        <form action="{{ route('medication.update', $medication->id) }}" method="POST">
            @csrf 
            @method('PUT')

            <div class="form-group">
                <label>Nombre del Medicamento</label>
                <input type="text" name="name" value="{{ $medication->name }}" required>
            </div>

            <div class="form-group">
                <label>Dosis</label>
                <input type="text" name="dosage" value="{{ $medication->dosage }}" required>
            </div>

            <div class="form-group">
                <label>Frecuencia</label>
                <input type="text" name="frequency" value="{{ $medication->frequency }}" required>
            </div>

            <div class="form-group">
                <label>Tratamiento Asociado</label>
                <select name="treatment_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($treatments as $treatment)
                        <option value="{{ $treatment->id }}" {{ $medication->treatment_id == $treatment->id ? 'selected' : '' }}>
                            {{ $treatment->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Diagnóstico Relacionado</label>
                <select name="diagnostic_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($diagnostics as $diagnostic)
                        <option value="{{ $diagnostic->id }}" {{ $medication->diagnostic_id == $diagnostic->id ? 'selected' : '' }}>
                            {{ $diagnostic->diagnostic_type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Paciente</label>
                <select name="patient_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $medication->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Médico Encargado</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $medication->doctor_id == $doctor->id ? 'selected' : '' }}>
                            Dr(a). {{ $doctor->first_name }} {{ $doctor->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Proveedor (Provider)</label>
                <input type="text" name="Provider" value="{{ $medication->Provider }}" required>
            </div>

            <div class="form-group">
                <label>Efectos Secundarios</label>
                <input type="text" name="secundary_effects" value="{{ $medication->secundary_effects }}">
            </div>

            <button type="submit" class="btn-submit">Actualizar Medicamento</button>
        </form>
    </div>
</body>
</html>