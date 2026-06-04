<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    // Redirige al usuario a la página de inicio de sesión de Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Obtiene la información del usuario desde Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Buscar si el usuario ya existe por su email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Si no existe, lo creamos en la base de datos (Registro)
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), // Contraseña aleatoria segura
                    // Opcional: puedes guardar el google_id si añades la columna a tu tabla users
                ]);
            }

            // Iniciar sesión en Laravel
            Auth::login($user);

            // Redirigir al panel principal o dashboard
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            // Si algo sale mal, redirigir al login con un error
            return redirect('/login')->with('error', 'Hubo un problema al iniciar sesión con Google.');
        }
    }
}