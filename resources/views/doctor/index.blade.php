<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Completo de Médicos</title>
    @vite(['resources/css/patient/patients.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container-full">
<div class="btn-exit">
    <a href="{{ route('home') }}" class="btn btn-primary">Volver</a>
</div>

<div class="table-header">
    <h2>Panel de Profesionales</h2>
    <div class="header-actions">
        <form action="{{ route('doctor.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Buscar por Nombre o Especialidad..." value="{{ request('search') }}" class="search-input" required>
            </div>
            <button type="submit" class="search-submit-btn">Buscar</button>
            @if(request('search'))
                <a href="{{ route('doctor.index') }}" class="search-submit-btn" style="margin-left: 5px; text-decoration: none; align-self: center;">Limpiar</a>
            @endif
        </form>

        <a href="{{ route('doctor.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-user-plus"></i> Registrar Médico
        </a>
    </div>
</div>
</div>

    <div class="container-full">
        <div class="table-card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>N° Licencia / CMP</th>
                            <th>Especialidad</th>
                            <th>Experiencia</th> {{-- <--- NUEVA COLUMNA --}}
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $doctor)
                            <tr>
                                <td><span class="id-badge">#{{ $doctor->id }}</span></td>
                                <td class="user-name">Dr(a). {{ $doctor->first_name }} {{ $doctor->last_name }}</td>
                                <td><strong>{{ $doctor->license }}</strong></td>
                                <td>{{ $doctor->speciality }}</td>
                                <td>{{ $doctor->years_of_experience }} años</td> {{-- <--- DATO AGREGADO --}}
                                <td>{{ $doctor->phone ?? '-' }}</td>
                                <td>{{ $doctor->email ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="action-group">
                                        <a href="{{ route('doctor.edit', $doctor->id) }}" class="action-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Eliminar" onclick="return confirm('¿Seguro de que deseas eliminar a este médico?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center empty-cell">No hay médicos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>