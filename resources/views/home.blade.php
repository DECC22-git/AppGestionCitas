<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - Panel de Control</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <style>
            /* --- VARIABLES DE COLOR (Celeste, Cyan, Lila) --- */
            :root {
                --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                --bg-dark: #090d16;
                --panel-dark: #111827;
                --border-color: rgba(255, 255, 255, 0.08);
                
                --cyan: #22d3ee;
                --sky: #0ea5e9;
                --purple: #a855f7;
                --text-muted: #94a3b8;
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: var(--font-sans);
                background-color: var(--bg-dark);
                color: #ffffff;
                min-height: 100vh;
                display: flex;
                -webkit-font-smoothing: antialiased;
            }

            /* --- DISTRIBUCIÓN DEL DASHBOARD --- */
            .dashboard-layout {
                display: flex;
                width: 100%;
                min-height: 100vh;
            }

            /* Sidebar (Barra Lateral) */
            .sidebar {
                width: 260px;
                background-color: var(--panel-dark);
                border-right: 1px solid var(--border-color);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 24px;
                position: fixed;
                height: 100vh;
                z-index: 20;
            }

            .sidebar-brand {
                font-size: 20px;
                font-weight: 700;
                text-decoration: none;
                background: linear-gradient(to right, #38bdf8, var(--cyan), #c084fc);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 40px;
                display: block;
            }

            .sidebar-menu {
                list-style: none;
                display: flex;
                flex-direction: column;
                gap: 8px;
                flex: 1;
            }

            .menu-link {
                display: flex;
                align-items: center;
                padding: 12px 16px;
                color: var(--text-muted);
                text-decoration: none;
                font-weight: 600;
                font-size: 14px;
                border-radius: 12px;
                transition: all 0.2s;
            }

            .menu-link.active, .menu-link:hover {
                color: #ffffff;
                background: rgba(34, 211, 238, 0.1);
                border-left: 3px solid var(--cyan);
            }

            .sidebar-footer {
                border-top: 1px solid var(--border-color);
                padding-top: 16px;
            }

            .logout-btn {
                background: transparent;
                border: none;
                color: #ef4444;
                font-weight: 600;
                cursor: pointer;
                width: 100%;
                text-align: left;
                padding: 12px 16px;
                font-size: 14px;
            }

            /* Contenedor Principal */
            .main-content {
                flex: 1;
                margin-left: 260px;
                padding: 40px;
                max-width: 1400px;
            }

            /* Encabezado del Panel */
            .main-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 40px;
            }

            .user-profile {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--sky), var(--purple));
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 14px;
                border: 2px solid rgba(255, 255, 255, 0.2);
            }

            /* --- TARJETAS DE ESTADÍSTICAS (Ocupando mejor el espacio) --- */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 24px;
            }

            .stat-card {
                background-color: var(--panel-dark);
                border: 1px solid var(--border-color);
                border-radius: 20px;
                padding: 32px 24px;
                position: relative;
                overflow: hidden;
            }

            .stat-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 4px;
                height: 100%;
            }
            .card-cyan::before { background: var(--cyan); }
            .card-sky::before { background: var(--sky); }
            .card-purple::before { background: var(--purple); }

            .stat-title {
                font-size: 14px;
                color: var(--text-muted);
                font-weight: 600;
                margin-bottom: 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .stat-value {
                font-size: 36px;
                font-weight: 800;
            }
        </style>
    </head>
    <body>

        <div class="dashboard-layout">
            
            <aside class="sidebar">
                <div>
                    <a href="#" class="sidebar-brand">
                        {{ config('app.name', 'MedicalApp') }}
                    </a>
                    <ul class="sidebar-menu">
                        <li><a href="#" class="menu-link active">📅 Mis Citas</a></li>
                        <li><a href="#" class="menu-link">👥 Profesionales</a></li>
                        <li><a href="#" class="menu-link">💳 Facturación</a></li>
                        <li><a href="#" class="menu-link">⚙️ Configuración</a></li>
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
                    <div class="stat-card card-cyan">
                        <div class="stat-title">Próximas Citas</div>
                        <div class="stat-value">3</div>
                    </div>
                    <div class="stat-card card-sky">
                        <div class="stat-title">Citas Completadas</div>
                        <div class="stat-value">12</div>
                    </div>
                    <div class="stat-card card-purple">
                        <div class="stat-title">Consultorios Activos</div>
                        <div class="stat-value">4</div>
                    </div>
                </section>

            </main>
        </div>

    </body>
</html>