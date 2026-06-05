<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    @vite(['resources/css/create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('patient.index') }}" class="btn-back">← Volver</a>
            <h2>Editar Paciente</h2>
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

        <form action="{{ route('patient.update', $patient->id) }}" method="POST">
            @csrf 
            @method('PUT')

            <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="first_name" value="{{ $patient->first_name }}" required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" value="{{ $patient->last_name }}" required>
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="birth_date" value="{{ $patient->birth_date }}" required>
            </div>

            <div class="form-group">
                <label>Género</label>
                <input type="text" name="gender" value="{{ $patient->gender }}" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" name="phone" value="{{ $patient->phone }}">
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" value="{{ $patient->address }}">
            </div>

            <div class="form-group">
                <label>Tipo de Sangre</label>
                <input type="text" name="blood_type" value="{{ $patient->blood_type }}">
            </div>

            <button type="submit" class="btn-submit">Actualizar Cambios</button>
        </form>

    </div>

</body>
</html>