<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Citas Médicas</title>
    @vite(['resources/css/style.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container-full">
<div class="btn-exit">
    <a href="{{ route('home') }}" class="btn btn-primary">Volver</a>
</div>

<div class="table-header">
    <h2>Panel de Citas Médicas</h2>
    <div class="header-actions">
        <form action="{{ route('appointment.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Buscar por motivo, consultorio, médico..." value="{{ request('search') }}" class="search-input" required>
            </div>
            <button type="submit" class="search-submit-btn">Buscar</button>
            @if(request('search'))
                <a href="{{ route('appointment.index') }}" class="search-submit-btn" style="margin-left: 5px; text-decoration: none; align-self: center;">Limpiar</a>
            @endif
        </form>

        <a href="{{ route('appointment.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-calendar-plus"></i> Agendar Cita
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
                            <th>Fecha y Hora</th>
                            <th>Paciente</th>
                            <th>Médico / Especialidad</th>
                            <th>Consultorio</th>
                            <th>Motivo</th>
                            <th>Observaciones</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr>
                                <td><span class="id-badge">#{{ $appointment->id }}</span></td>
                                <td><strong>{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y h:i A') }}</strong></td>
                                <td class="user-name">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                                <td>Dr(a). {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }} <small class="text-muted">({{ $appointment->doctor->specialty }})</small></td>
                                <td><span class="status-badge status-active">{{ $appointment->room }}</span></td>
                                <td>{{ $appointment->reason }}</td>
                                <td class="text-truncate-dir" title="{{ $appointment->observations }}">{{ $appointment->observations ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="action-group">
                                        <a href="{{ route('appointment.edit', $appointment->id) }}" class="action-btn edit-btn" title="Editar Cita">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Cancelar Cita" onclick="return confirm('¿Seguro de que deseas cancelar esta cita?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center empty-cell">No hay citas médicas programadas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>