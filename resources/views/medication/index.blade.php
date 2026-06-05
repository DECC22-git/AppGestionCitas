<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario y Registro de Medicamentos</title>
    @vite(['resources/css/style.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container-full">
<div class="btn-exit">
    <a href="{{ route('home') }}" class="btn btn-primary">Volver</a>
</div>

<div class="table-header">
    <h2>Panel de Medicamentos Asignados</h2>
    <div class="header-actions">
        <form action="{{ route('medication.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Buscar por medicamento, proveedor, paciente..." value="{{ request('search') }}" class="search-input" required>
            </div>
            <button type="submit" class="search-submit-btn">Buscar</button>
            @if(request('search'))
                <a href="{{ route('medication.index') }}" class="search-submit-btn" style="margin-left: 5px; text-decoration: none; align-self: center;">Limpiar</a>
            @endif
        </form>

        <a href="{{ route('medication.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-prescription-bottle-medical"></i> Registrar Medicamento
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
                            <th>Fármaco / Medicamento</th>
                            <th>Dosis</th>
                            <th>Frecuencia</th>
                            <th>Paciente</th>
                            <th>Proveedor</th>
                            <th>Efectos Secundarios</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medications as $medication)
                            <tr>
                                <td><span class="id-badge">#{{ $medication->id }}</span></td>
                                <td class="user-name">{{ $medication->name }}</td>
                                <td><strong>{{ $medication->dosage }}</strong></td>
                                <td>{{ $medication->frequency }}</td>
                                <td>{{ $medication->patient->first_name }} {{ $medication->patient->last_name }}</td>
                                <td><span class="status-badge status-active">{{ $medication->Provider }}</span></td>
                                <td class="text-truncate-dir" title="{{ $medication->secundary_effects }}">{{ $medication->secundary_effects ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="action-group">
                                        <a href="{{ route('medication.edit', $medication->id) }}" class="action-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('medication.destroy', $medication->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este medicamento?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center empty-cell">No hay medicamentos registrados en el sistema.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>