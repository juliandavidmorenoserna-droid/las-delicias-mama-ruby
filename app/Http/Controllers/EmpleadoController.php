<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Listar empleados con búsqueda y filtros.
     */
    public function index(Request $request)
    {
        $buscar = $request->query('buscar');
        $estado = $request->query('estado');

        $query = Empleado::orderBy('nombre');

        if (!empty($buscar)) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('documento', 'like', "%{$buscar}%")
                  ->orWhere('cargo', 'like', "%{$buscar}%");
            });
        }

        if (!empty($estado)) {
            $query->where('estado', $estado);
        }

        $empleados = $query->paginate(15);

        return view('empleados.index', compact('empleados', 'buscar', 'estado'));
    }

    /**
     * Mostrar formulario para registrar un empleado.
     */
    public function create()
    {
        return view('empleados.crear');
    }

    /**
     * Guardar un nuevo empleado.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'documento' => 'required|string|max:50|unique:empleados,documento',
            'telefono' => 'nullable|string|max:50',
            'cargo' => 'required|string|max:100',
            'salario' => 'required|numeric|min:0',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        Empleado::create($datos);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado registrado correctamente.');
    }

    /**
     * Ver perfil y ficha del empleado.
     */
    public function show(Empleado $empleado)
    {
        return view('empleados.ver', compact('empleado'));
    }

    /**
     * Mostrar formulario para editar empleado.
     */
    public function edit(Empleado $empleado)
    {
        return view('empleados.editar', compact('empleado'));
    }

    /**
     * Actualizar información del empleado.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'documento' => 'required|string|max:50|unique:empleados,documento,' . $empleado->id,
            'telefono' => 'nullable|string|max:50',
            'cargo' => 'required|string|max:100',
            'salario' => 'required|numeric|min:0',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $empleado->update($datos);

        return redirect()->route('empleados.index')
            ->with('success', 'Información del empleado actualizada correctamente.');
    }

    /**
     * Eliminar un empleado.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado del sistema.');
    }
}
