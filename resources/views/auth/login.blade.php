<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MedicApp') }} - Login</title>

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #0b0f19 !important;
            overflow-x: hidden !important;
            font-family: 'Nunito', sans-serif;
        }
        label {
            color: white !important;
        }


        .form-control-medical::placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
            opacity: 1 !important;
        }
        .form-control-medical:-ms-input-placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        .form-control-medical::-ms-input-placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        .text-muted.text-uppercase, .login-content .text-muted {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .super-login-block {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            z-index: 9999 !important;
        }

        .navbar-custom {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            background-color: rgba(11, 15, 25, 0.7) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            z-index: 10000 !important;
        }
        
        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.6) !important;
            transition: color 0.2s;
        }

        .navbar-custom .nav-link:hover {
            color: #00f2fe !important;
        }

        .login-bg-full {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background-image: url("{{ asset('img/imagensenati1.jpg') }}") !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            filter: brightness(0.25) contrast(1.1) !important;
            z-index: 1 !important;
        }

        .login-content {
            position: relative !important;
            z-index: 10 !important;
            width: 100% !important;
            margin-top: 50px;
        }

        .form-control-medical {
            background-color: #121824 !important;
            border: 1px solid #232d42 !important;
            color: #ffffff !important;
            transition: all 0.3s ease;
        }

        /* Enfoque lila + cyan para el input */
        .form-control-medical:focus {
            border-color: #b624ff !important;
            box-shadow: 0 0 10px rgba(182, 36, 255, 0.25), 0 0 5px rgba(0, 242, 254, 0.2) !important;
            background-color: #161f30 !important;
        }

        /* Botón primario con transición lila */
        .btn-medical-primary {
            background: linear-gradient(135deg, #0052d4 0%, #b624ff 50%, #00f2fe 100%) !important;
            border: none !important;
            color: white !important;
            background-size: 200% auto !important;
            transition: all 0.4s ease !important;
        }

        .btn-medical-primary:hover {
            background-position: right center !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(182, 36, 255, 0.4) !important;
        }

        /* --- EFECTO CORAZÓN LATIENDO (CSS PURO) --- */
        .heart-container {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .medical-heart {
            position: relative;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #b624ff 0%, #00f2fe 100%);
            transform: rotate(-45deg);
            animation: heartbeat 1.2s infinite ease-in-out;
            filter: drop-shadow(0 0 12px rgba(182, 36, 255, 0.6));
        }

        .medical-heart::before,
        .medical-heart::after {
            content: "";
            position: absolute;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #b624ff 0%, #00f2fe 100%);
            border-radius: 50%;
        }

        .medical-heart::before {
            top: -20px;
            left: 0;
        }

        .medical-heart::after {
            top: 0;
            left: 20px;
        }

        @keyframes heartbeat {
            0% { transform: rotate(-45deg) scale(1); filter: drop-shadow(0 0 8px rgba(182, 36, 255, 0.5)); }
            20% { transform: rotate(-45deg) scale(1.25); filter: drop-shadow(0 0 20px rgba(0, 242, 254, 0.8)); }
            40% { transform: rotate(-45deg) scale(1.05); filter: drop-shadow(0 0 12px rgba(182, 36, 255, 0.6)); }
            60% { transform: rotate(-45deg) scale(1.2); filter: drop-shadow(0 0 18px rgba(182, 36, 255, 0.7)); }
            100% { transform: rotate(-45deg) scale(1); filter: drop-shadow(0 0 8px rgba(182, 36, 255, 0.5)); }
        }

        .btn-google-custom {
            background-color: #121824; 
            border: 1px solid #232d42; 
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-google-custom:hover {
            background-color: #1c263b;
            border-color: #00f2fe;
        }

        /* --- BOTÓN GITHUB PREMIUM --- */
        .btn-github-custom {
            background-color: #121824 !important;
            border: 1px solid #232d42 !important;
            border-radius: 8px;
            transition: all 0.3s ease !important;
            position: relative;
        }
        .btn-github-custom:hover {
            background-color: #171e2d !important;
            border-color: #b624ff !important;
            box-shadow: 0 0 12px rgba(182, 36, 255, 0.3) !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand navbar-dark navbar-custom py-2">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="{{ url('/') }}">
            <span style="color: #00f2fe;">Medical</span>Center
        </a>
        <div class="ms-auto">
            <ul class="navbar-nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3 text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="super-login-block">
    <div class="login-bg-full"></div>

    <div class="container d-flex align-items-center justify-content-center login-content">
        <div class="row justify-content-center w-100">
            <div class="col-md-10 col-lg-9">
                <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 16px; background-color: #161c2a; border: 1px solid rgba(255, 255, 255, 0.05) !important;">
                    <div class="row g-0">
                        
                        <div class="col-md-5 d-none d-md-flex flex-column align-items-center justify-content-center p-4" style="background-color: #0b0f19 !important; border-right: 1px solid #232d42;">
                            <div class="heart-container">
                                <div class="medical-heart"></div>
                            </div>
                            <h5 class="text-white mt-3 fw-bold text-center">¡Bienvenido de vuelta!</h5>
                            <p class="text-muted small text-center px-3">Ingresa al portal para gestionar tu historial médico y tus próximas citas.</p>
                            <hr class="border-secondary w-75 my-3 opacity-25">
                            <p class="text-muted small mb-2 text-center">¿No tienes una cuenta?</p>
                            <a href="{{ route('register') }}" class="btn btn-sm btn-outline-info w-75 fw-semibold py-2" style="border-color: #00f2fe; color: #00f2fe;">
                                {{ __('Registrarse') }}
                            </a>
                        </div>

                        <div class="col-md-7 p-4 p-sm-5" style="background-color: rgba(22, 28, 42, 0.95); border-left: 1px solid rgba(182, 36, 255, 0.1);">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="text-white fw-bold m-0">{{ __('Iniciar Sesión') }}</h3>
                                <span class="small fw-bold" style="color: #00f2fe !important;">Portal Clínico</span>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label text-light small fw-semibold">{{ __('Correo Electrónico') }}</label>
                                    <input id="email" type="email" class="form-control form-control-medical py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nombre@ejemplo.com">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="password" class="form-label text-light small fw-semibold">{{ __('Contraseña') }}</label>
                                        @if (Route::has('password.request'))
                                            <a class="small text-decoration-none" style="color: #00f2fe;" href="{{ route('password.request') }}">
                                                {{ __('¿Olvidaste tu contraseña?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <input id="password" type="password" class="form-control form-control-medical py-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-4 form-check">
                                    <input class="form-check-input bg-dark border-secondary" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted small user-select-none" for="remember">
                                        {{ __('Recordar sesión en este equipo') }}
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-medical-primary w-100 fw-semibold py-2 shadow-sm mb-3">
                                    {{ __('Ingresar al Sistema') }}
                                </button>
                            </form>

                            <div class="d-flex align-items-center my-3">
                                <hr class="flex-grow-1 border-secondary m-0 opacity-25">
                                <span class="px-3 text-muted small text-uppercase">O también</span>
                                <hr class="flex-grow-1 border-secondary m-0 opacity-25">
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('auth.google') }}" class="btn btn-google-custom w-100 d-flex align-items-center justify-content-center text-white py-2 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google me-2" viewBox="0 0 16 16">
                                        <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0c2.158 0 4 .799 5.435 2.1l-2.234 2.234c-1.253-1.192-2.997-1.926-5.201-1.926-3.864 0-7 3.136-7 7s3.136 7 7 7c4.28 0 5.925-3.05 6.195-4.666h-6.195V6.558h5.545z"/>
                                    </svg>
                                    <span class="fw-semibold small">{{ __('Iniciar sesión con Google') }}</span>
                                </a>
                                <a href="{{ route('auth.github') }}" class="btn btn-github-custom w-100 d-flex align-items-center justify-content-center text-white py-1">
                                    <div style="width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; overflow: hidden;" class="me-1">
                                        <dotlottie-wc src="{{ asset('animations/github.lottie') }}" style="width: 100%; height: 100%; transform: scale(1.4);" autoplay loop></dotlottie-wc>
                                    </div>
                                    <span class="fw-semibold small">{{ __('Iniciar sesión con GitHub') }}</span>
                                </a> 
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>