<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - Reserva tu Cita</title>
        @vite(['resources/css/welcome.css'])
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    </head>
    <body>
        
        <div class="glow-orb orb-1"></div>
        <div class="glow-orb orb-2"></div>

        <header>
            <a href="/" class="logo text-glow-gradient">
                {{ config('app.name', 'Laravel') }}
            </a>

            @if (Route::has('login'))
                <nav class="nav-container">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Iniciar Sesión</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-btn-register">Registrarse</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main>
            <div class="welcome-card">
                
                <div class="welcome-badge">
                    <span class="badge-dot"></span>
                    ¡Te damos la bienvenida!
                </div>

                <h1>
                    Gestiona tu tiempo.<br>
                    <span class="text-glow-gradient">Registrar cita en agenda</span>
                </h1>

                <p class="subtitle">
                    "Supervisa agendas, gestiona horarios disponibles y asigna profesionales en tiempo real. Optimiza la ocupación de la clínica de forma rápida, segura y completamente centralizada."
                </p>

                <div class="cta-group">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary-cta">
                            Comienza a realizar Registros de citas
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary-cta">
                            Realizar registros 
                        </a>
                    @endauth
                </div>

            </div>
        </main>

        <footer>
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.
        </footer>

    </body>
</html>