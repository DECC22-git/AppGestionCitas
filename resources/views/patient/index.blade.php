<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Completo de Pacientes</title>
    
    @vite(['resources/css/style.css'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container-full">
<div class="btn-exit">
    <a href="{{ route('home') }}" class="btn btn-primary">Volver</a>
</div>

<div class="table-header">
    <h2>Panel de Pacientes</h2>
    <div class="header-actions">


        <form action="{{ route('patient.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar por Nombre o Tipo de Sangre..." 
                    value="{{ request('search') }}"
                    class="search-input"
                    required
                >
            </div>
            <button type="submit" class="search-submit-btn">Buscar</button>
            
            {{-- CORREGIDO: Usando 'patient.index' en singular --}}
            @if(request('search'))
                <a href="{{ route('patient.index') }}" class="search-submit-btn" style="margin-left: 5px; text-decoration: none; align-self: center;">Limpiar</a>
            @endif
        </form>

        {{-- CORREGIDO: Usando 'patient.create' en singular --}}
        <a href="{{ route('patient.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-user-plus"></i> Registrar Paciente
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
                            <th>F. Nacimiento</th>
                            <th>Género</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Tipo Sangre</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Lee la variable $patients que manda el controlador --}}
                        @forelse($patients as $patient)
                            <tr>
                                <td><span class="id-badge">#{{ $patient->id }}</span></td>
                                <td class="user-name">{{ $patient->first_name }} {{ $patient->last_name }}</td>
                                <td>{{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->format('d/m/Y') : '-' }}</td>
                                <td>{{ $patient->gender }}</td>
                                <td>{{ $patient->phone ?? '-' }}</td>
                                <td class="text-truncate-dir" title="{{ $patient->address }}">{{ $patient->address ?? '-' }}</td>
                                <td>
                                    <span class="status-badge status-active">{{ $patient->blood_type ?? 'Sin asignar' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-group">
                                        {{-- CORREGIDO: Usando 'patient.edit' en singular --}}
                                        <a href="{{ route('patient.edit', $patient->id) }}" class="action-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        
                                        {{-- CORREGIDO: Usando 'patient.destroy' en singular --}}
                                        <form action="{{ route('patient.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Eliminar" onclick="return confirm('¿Seguro de que deseas eliminar a este paciente?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center empty-cell">No hay pacientes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>