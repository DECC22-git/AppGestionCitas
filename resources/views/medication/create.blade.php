<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Medicamento</title>
    @vite(['resources/css/create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('medication.index') }}" class="btn-back">← Volver</a>
            <h2>Nuevo Medicamento</h2>
        </div>

        <form action="{{ route('medication.store') }}" method="POST">
            @csrf 
            
            <div class="form-group">
                <label>Nombre del Medicamento</label>
                <input type="text" name="name" placeholder="Ej. Paracetamol 500mg" required>
            </div>

            <div class="form-group">
                <label>Dosis</label>
                <input type="text" name="dosage" placeholder="Ej. 1 tableta, 5ml" required>
            </div>

            <div class="form-group">
                <label>Frecuencia</label>
                <input type="text" name="frequency" placeholder="Ej. Cada 12 horas, diario" required>
            </div>

            <div class="form-group">
                <label>Tratamiento Asociado</label>
                <select name="treatment_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="">-- Seleccione el Tratamiento --</option>
                    @foreach($treatments as $treatment)
                        <option value="{{ $treatment->id }}">Trat. #{{ $treatment->id }} - {{ $treatment->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Diagnóstico Relacionado</label>
                <select name="diagnostic_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="">-- Seleccione el Diagnóstico --</option>
                    @foreach($diagnostics as $diagnostic)
                        <option value="{{ $diagnostic->id }}">Diag. #{{ $diagnostic->id }} - {{ $diagnostic->diagnostic_type }}</option>
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
                <label>Médico Encargado</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="">-- Seleccione un Médico --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">Dr(a). {{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Proveedor (Provider)</label>
                <input type="text" name="Provider" placeholder="Ej. Farmacia Central, Pfizer" required>
            </div>

            <div class="form-group">
                <label>Efectos Secundarios</label>
                <input type="text" name="secundary_effects" placeholder="Ej. Somnolencia, mareos ligeros">
            </div>

            <button type="submit" class="btn-submit">Guardar Medicamento</button>
            
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