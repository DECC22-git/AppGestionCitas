<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Médico</title>
     @vite(['resources/css/create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('doctor.index') }}" class="btn-back">← Volver</a>
            <h2>Editar Médico</h2>
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

        <form action="{{ route('doctor.update', $doctor->id) }}" method="POST">
            @csrf 
            @method('PUT')

            <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="first_name" value="{{ $doctor->first_name }}" required>
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" value="{{ $doctor->last_name }}" required>
            </div>
            <div class="form-group">
                <label>Especialidad</label>
                <input type="text" name="speciality" value="{{ $doctor->speciality }}" required>
            </div>
            <div class="form-group">
                <label>Número de Licencia / Colegiatura</label>
                <input type="text" name="license" value="{{ $doctor->license }}" required>
            </div>

            {{-- SECCIÓN AGREGADA --}}
            <div class="form-group">
                <label>Años de Experiencia</label>
                <input type="number" name="years_of_experience" min="0" value="{{ $doctor->years_of_experience }}" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" name="phone" value="{{ $doctor->phone }}">
            </div>
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" value="{{ $doctor->email }}">
            </div>

            <button type="submit" class="btn-submit">Actualizar Cambios</button>
        </form>
    </div>
</body>
</html>