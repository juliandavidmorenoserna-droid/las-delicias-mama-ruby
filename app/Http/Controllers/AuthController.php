<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de inicio de sesión.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirigirPorRol(Auth::user());
        }

        return view('auth.login');
    }

    /**
     * Procesar inicio de sesión.
     */
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Debes ingresar un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $recordar = $request->boolean('remember');

        if (Auth::attempt($credenciales, $recordar)) {
            $request->session()->regenerate();

            $usuario = Auth::user();

            return $this->redirigirPorRol($usuario)
                ->with('success', '¡Bienvenido(a), ' . $usuario->name . '!');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Mostrar formulario de registro.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirigirPorRol(Auth::user());
        }

        return view('auth.register');
    }

    /**
     * Registrar un nuevo usuario.
     */
    public function register(Request $request)
    {
        $datos = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
            'rol'                   => 'required|in:admin,cliente,empleado',
        ], [
            'name.required'     => 'El nombre completo es obligatorio.',
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Ingresa un correo electrónico válido.',
            'email.unique'      => 'Este correo ya está registrado en el sistema.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed'=> 'Las contraseñas no coinciden.',
            'rol.required'      => 'Debes seleccionar un tipo de cuenta.',
            'rol.in'            => 'El tipo de cuenta seleccionado no es válido.',
        ]);

        $usuario = User::create([
            'name'     => $datos['name'],
            'email'    => $datos['email'],
            'password' => Hash::make($datos['password']),
            'rol'      => $datos['rol'],
        ]);

        Auth::login($usuario);

        $request->session()->regenerate();

        return $this->redirigirPorRol($usuario)
            ->with('success', '¡Cuenta creada con éxito! Bienvenido(a), ' . $usuario->name . '.');
    }

    /**
     * Cerrar sesión.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Has cerrado sesión correctamente.');
    }

    /**
     * Redirigir al usuario según su rol.
     */
    private function redirigirPorRol($usuario)
    {
        return match ($usuario->rol) {
            'cliente'  => redirect()->route('cliente.menu'),
            'empleado' => redirect()->route('empleado.mesas'),
            default    => redirect()->route('inicio'),
        };
    }
}
