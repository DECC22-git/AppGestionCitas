<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Médico</title>
    @vite(['resources/css/patient/patient-create.css'])
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('doctor.index') }}" class="btn-back">← Volver</a>
            <h2>Nuevo Médico</h2>
        </div>

        <form action="{{ route('doctor.store') }}" method="POST">
            @csrf 
            <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="first_name" placeholder="Ej. Carlos" required>
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" placeholder="Ej. Mendoza" required>
            </div>
            <div class="form-group">
                <label>Especialidad</label>
                <input type="text" name="speciality" placeholder="Ej. Cardiología, Pediatría" required>
            </div>
            <div class="form-group">
                <label>Número de Licencia / Colegiatura</label>
                <input type="text" name="license" placeholder="Ej. CMP-84732" required>
            </div>
            
            {{-- SECCIÓN AGREGADA --}}
            <div class="form-group">
                <label>Años de Experiencia</label>
                <input type="number" name="years_of_experience" min="0" placeholder="Ej. 5" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" name="phone" placeholder="Ej. 912345678">
            </div>
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" placeholder="Ej. carlos.mendoza@medicalapp.com">
            </div>

            <button type="submit" class="btn-submit">Guardar Médico</button>
            
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