<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Paciente</title>
    @vite(['resources/css/create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('patient.index') }}" class="btn-back">← Volver</a>
            <h2>Nuevo Paciente</h2>
        </div>

        <form action="{{ route('patient.store') }}" method="POST">
            @csrf 
            
            <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="first_name" placeholder="Ej. Alejandro" required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" placeholder="Ej. Alva" required>
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="birth_date" required>
            </div>

            <div class="form-group">
                <label>Género</label>
                <input type="text" name="gender" placeholder="Ej. Masculino, Femenino" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" name="phone" placeholder="Ej. 987654321">
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" placeholder="Ej. Av. Alfredo Mendiola 3520">
            </div>

            <div class="form-group">
                <label>Tipo de Sangre</label>
                <input type="text" name="blood_type" placeholder="Ej. O+, A-">
            </div>

            <button type="submit" class="btn-submit">Guardar Paciente</button>
            
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