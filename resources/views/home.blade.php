<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - Panel de Control</title>
        @vite(['resources/css/home.css'])
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    </head>
    <body>

        <div class="dashboard-layout">
            
            <aside class="sidebar">
                <div>
                    {{-- CORREGIDO: Redirige al Dashboard principal --}}
                    <a href="{{ url('/home') }}" class="sidebar-brand">
                        {{ config('app.name', 'MedicalApp') }}
                    </a>
                    <ul class="sidebar-menu">
                        {{-- CORREGIDO: Enlazado a recursos en singular según tus rutas definidas --}}
                        <li><a href="{{ route('appointment.index') }}" class="menu-link">📅 Citas</a></li>
                        <li><a href="{{ route('doctor.index') }}" class="menu-link">👥 Profesionales</a></li>
                        <li><a href="{{ route('patient.index') }}" class="menu-link">👤 Pacientes</a></li>
                        <li><a href="{{ route('diagnostic.index') }}" class="menu-link">📋 Diagnósticos</a></li>
                        <li><a href="{{ route('treatment.index') }}" class="menu-link">🧪 Tratamientos</a></li>
                        <li><a href="{{ route('medication.index') }}" class="menu-link">💊 Medicinas</a></li>
                    </ul>
                </div>
                <div class="sidebar-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            🚪 Cerrar Sesión
                        </button>
                    </form>
                </div>
            </aside>

            <main class="main-content">
                
                <header class="main-header">
                    <div>
                        <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -0.5px;">Panel de Gestión</h1>
                        <p style="color: var(--text-muted); font-size: 14px; margin-top: 4px;">Bienvenido de vuelta, {{ Auth::user()->name ?? 'Daniel Celiz' }}</p>
                    </div>
                    <div class="user-profile">
                        <div class="avatar">
                            {{ strtoupper(substr(Auth::user()->name ?? 'DA', 0, 2)) }}
                        </div>
                    </div>
                </header>

                <section class="stats-grid">
                    {{-- TARJETA 1: PACIENTES (Antes Próximas Citas) --}}
                    <div class="stat-card card-cyan">
                        <div class="stat-title">Número de Pacientes</div>
                        <div class="stat-value">{{ $totalPacientes ?? 0 }}</div>
                    </div>

                    {{-- TARJETA 2: DOCTORES (Antes Citas Completadas) --}}
                    <div class="stat-card card-sky">
                        <div class="stat-title">Número de Doctores</div>
                        <div class="stat-value">{{ $totalDoctores ?? 0 }}</div>
                    </div>

                    {{-- TARJETA 3: CITAS (Antes Consultorios Activos) --}}
                    <div class="stat-card card-purple">
                        <div class="stat-title">Número de Citas</div>
                        <div class="stat-value">{{ $totalCitas ?? 0 }}</div>
                    </div>
                </section>

            </main>
        </div>

    </body>
</html>