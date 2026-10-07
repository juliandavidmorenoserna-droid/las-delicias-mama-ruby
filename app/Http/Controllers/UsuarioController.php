<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Lista de todos los usuarios del sistema.
     */
    public function index()
    {
        $usuarios = User::orderBy('rol')->orderBy('name')->get();
        $totalAdmins = User::where('rol', 'admin')->count();

        return view('admin.usuarios.index', compact('usuarios', 'totalAdmins'));
    }

    /**
     * Formulario para crear un nuevo usuario (empleado o admin).
     */
    public function create()
    {
        $totalAdmins = User::where('rol', 'admin')->count();

        return view('admin.usuarios.crear', compact('totalAdmins'));
    }

    /**
     * Guardar nuevo usuario creado por el administrador.
     *
     * Reglas:
     * - Máximo 2 administradores en el sistema.
     * - Los empleados no tienen límite.
     * - El registro público solo crea clientes, no pasa por aquí.
     */
    public function store(Request $request)
    {
        $totalAdmins = User::where('rol', 'admin')->count();

        $datos = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'rol'      => 'required|in:admin,empleado',
        ], [
            'name.required'     => 'El nombre completo es obligatorio.',
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Ingresa un correo electrónico válido.',
            'email.unique'      => 'Este correo ya está registrado en el sistema.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed'=> 'Las contraseñas no coinciden.',
            'rol.required'      => 'Debes seleccionar el tipo de cuenta.',
            'rol.in'            => 'El tipo de cuenta no es válido.',
        ]);

        // ── Regla de negocio: máximo 2 administradores ──────────────────
        if ($datos['rol'] === 'admin' && $totalAdmins >= 2) {
            return back()
                ->withInput()
                ->with('error', '⛔ El sistema ya tiene 2 administradores, que es el máximo permitido. Para agregar uno nuevo, primero elimina uno existente.');
        }

        User::create([
            'name'     => $datos['name'],
            'email'    => $datos['email'],
            'password' => Hash::make($datos['password']),
            'rol'      => $datos['rol'],
        ]);

        $nombreRol = $datos['rol'] === 'admin' ? 'Administrador' : 'Empleado/Mesero';

        return redirect()->route('usuarios.index')
            ->with('success', "✅ {$nombreRol} '{$datos['name']}' creado correctamente. Ya puede iniciar sesión.");
    }

    /**
     * Eliminar un usuario del sistema.
     *
     * No se puede eliminar a uno mismo (el admin activo).
     */
    public function destroy(User $usuario)
    {
        $usuarioActual = auth()->user();

        // No puede eliminarse a sí mismo
        if ($usuarioActual->id === $usuario->id) {
            return back()->with('error', '⛔ No puedes eliminar tu propia cuenta mientras estás conectado.');
        }

        $nombre = $usuario->name;
        $rol    = $usuario->rol;

        $usuario->delete();

        $nombreRol = match ($rol) {
            'admin'    => 'Administrador',
            'empleado' => 'Empleado',
            default    => 'Cliente',
        };

        return redirect()->route('usuarios.index')
            ->with('success', "🗑️ {$nombreRol} '{$nombre}' eliminado del sistema.");
    }
}
