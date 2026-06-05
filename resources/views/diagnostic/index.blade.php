<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Diagnósticos</title>
    @vite(['resources/css/style.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container-full">
<div class="btn-exit">
    <a href="{{ route('home') }}" class="btn btn-primary">Volver</a>
</div>

<div class="table-header">
    <h2>Panel de Diagnósticos</h2>
    <div class="header-actions">
        <form action="{{ route('diagnostic.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Buscar por tipo, severidad o paciente..." value="{{ request('search') }}" class="search-input" required>
            </div>
            <button type="submit" class="search-submit-btn">Buscar</button>
            @if(request('search'))
                <a href="{{ route('diagnostic.index') }}" class="search-submit-btn" style="margin-left: 5px; text-decoration: none; align-self: center;">Limpiar</a>
            @endif
        </form>

        <a href="{{ route('diagnostic.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-file-medical"></i> Registrar Diagnóstico
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
                            <th>Fecha</th>
                            <th>Paciente</th>
                            <th>Médico</th>
                            <th>Tipo</th>
                            <th>Severidad</th>
                            <th>Descripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($diagnostics as $diagnostic)
                            <tr>
                                <td><span class="id-badge">#{{ $diagnostic->id }}</span></td>
                                <td><strong>{{ \Carbon\Carbon::parse($diagnostic->date)->format('d/m/Y h:i A') }}</strong></td>
                                <td class="user-name">{{ $diagnostic->patient->first_name }} {{ $diagnostic->patient->last_name }}</td>
                                <td>Dr(a). {{ $diagnostic->doctor->first_name }} {{ $diagnostic->doctor->last_name }}</td>
                                <td><strong>{{ $diagnostic->diagnostic_type }}</strong></td>
                                <td>
                                    <span class="status-badge" style="text-transform: capitalize; background-color: {{ 
                                        $diagnostic->severity == 'severe' ? '#f8d7da' : 
                                        ($diagnostic->severity == 'moderate' ? '#fff3cd' : 
                                        ($diagnostic->severity == 'mild' ? '#d1ecf1' : '#e2e3e5')) 
                                    }}; color: {{ 
                                        $diagnostic->severity == 'severe' ? '#721c24' : 
                                        ($diagnostic->severity == 'moderate' ? '#856404' : 
                                        ($diagnostic->severity == 'mild' ? '#0c5460' : '#383d41')) 
                                    }};">
                                        {{ $diagnostic->severity }}
                                    </span>
                                </td>
                                <td class="text-truncate-dir" title="{{ $diagnostic->description }}">{{ $diagnostic->description }}</td>
                                <td class="text-center">
                                    <div class="action-group">
                                        <a href="{{ route('diagnostic.edit', $diagnostic->id) }}" class="action-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('diagnostic.destroy', $diagnostic->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este diagnóstico?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center empty-cell">No hay diagnósticos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>