<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Dónde redirigir a los usuarios después del login.
     */
    protected $redirectTo = '/home';

    /**
     * Crear una nueva instancia del controlador.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirigir el usuario a la página de autenticación de Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtener la información del usuario de Google e iniciar sesión.
     */
    public function handleGoogleCallBack()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Buscar si el usuario ya existe por email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Si no existe, se crea un nuevo usuario
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(24)), // Contraseña aleatoria segura
                ]);
            }

            // Iniciar sesión manualmente
            Auth::login($user, true);

            // Redirigir al home
            return redirect($this->redirectTo);

        } catch (\Exception $e) {
            // Si algo falla (ej. el usuario cancela), redirigir de vuelta al login
            return redirect('/login')->with('error', 'Hubo un problema al iniciar sesión con Google.');
        }
    }

    /**
     * Hook para el login tradicional (Email/Password).
     * Se ejecuta AUTOMÁTICAMENTE después de que el usuario se autentica con éxito.
     */
    protected function authenticated(Request $request, $user)
    {
        // Guardar el User-Agent en la sesión
        $device = $request->header('User-Agent');
        $request->session()->put('device', $device);

        // CRUCIAL: Debes retornar la redirección aquí para que no se quede en blanco
        return redirect()->intended($this->redirectTo);
    }
    public function redirectToGithub()
{
    return Socialite::driver('github')->redirect();
}

// Callback de GitHub
public function handleGithubCallback()
{
    try {

        $githubUser = Socialite::driver('github')->user();

        // Obtener email
        $email = $githubUser->getEmail();

        // Obtener nombre
        $name = $githubUser->getName()
            ?? $githubUser->getNickname()
            ?? 'Usuario GitHub';

        // Buscar usuario
        $user = User::where('email', $email)->first();

        // Crear usuario si no existe
        if (!$user) {

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt(Str::random(16)),
            ]);
        }

        // Login
        Auth::login($user);

        return redirect('/home');

    } catch (\Exception $e) {

        return redirect('/login')
            ->with('error', 'Error con GitHub Login');
    }
}
}
