<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Tratamientos</title>
    @vite(['resources/css/style.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container-full">
<div class="btn-exit">
    <a href="{{ route('home') }}" class="btn btn-primary">Volver</a>
</div>

<div class="table-header">
    <h2>Panel de Tratamientos médicos</h2>
    <div class="header-actions">
        <form action="{{ route('treatment.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Buscar por tratamiento, estado o paciente..." value="{{ request('search') }}" class="search-input" required>
            </div>
            <button type="submit" class="search-submit-btn">Buscar</button>
            @if(request('search'))
                <a href="{{ route('treatment.index') }}" class="search-submit-btn" style="margin-left: 5px; text-decoration: none; align-self: center;">Limpiar</a>
            @endif
        </form>

        <a href="{{ route('treatment.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-pills"></i> Asignar Tratamiento
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
                            <th>Tratamiento</th>
                            <th>Paciente</th>
                            <th>Médico</th>
                            <th>Frecuencia</th>
                            <th>Duración</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($treatments as $treatment)
                            <tr>
                                <td><span class="id-badge">#{{ $treatment->id }}</span></td>
                                <td class="user-name">{{ $treatment->name }}</td>
                                <td>{{ $treatment->patient->first_name }} {{ $treatment->patient->last_name }}</td>
                                <td>Dr(a). {{ $treatment->doctor->first_name }} {{ $treatment->doctor->last_name }}</td>
                                <td>{{ $treatment->administration_frequency }}</td>
                                <td><strong>{{ $treatment->duration }}</strong></td>
                                <td>
                                    <span class="status-badge" style="text-transform: capitalize; background-color: {{ 
                                        $treatment->status == 'completed' ? '#d4edda' : 
                                        ($treatment->status == 'ongoing' ? '#cce5ff' : '#fff3cd') 
                                    }}; color: {{ 
                                        $treatment->status == 'completed' ? '#155724' : 
                                        ($treatment->status == 'ongoing' ? '#004085' : '#856404') 
                                    }};">
                                        {{ $treatment->status == 'ongoing' ? 'En Curso' : ($treatment->status == 'completed' ? 'Completado' : 'Pendiente') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="action-group">
                                        <a href="{{ route('treatment.edit', $treatment->id) }}" class="action-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('treatment.destroy', $treatment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este tratamiento?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center empty-cell">No hay tratamientos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>