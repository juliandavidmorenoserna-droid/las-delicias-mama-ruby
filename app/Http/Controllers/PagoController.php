<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Listar pagos registrados con filtros por empleado y fechas.
     */
    public function index(Request $request)
    {
        $empleadoId = $request->query('empleado_id');
        $concepto = $request->query('concepto');
        $fecha = $request->query('fecha');

        $query = Pago::with('empleado')->latest('fecha');

        if (!empty($empleadoId)) {
            $query->where('empleado_id', $empleadoId);
        }

        if (!empty($concepto)) {
            $query->where('concepto', 'like', "%{$concepto}%");
        }

        if (!empty($fecha)) {
            $query->whereDate('fecha', $fecha);
        }

        $pagos = $query->paginate(15);
        $empleados = Empleado::orderBy('nombre')->get();
        $totalPagado = Pago::sum('monto');

        return view('pagos.index', compact('pagos', 'empleados', 'empleadoId', 'concepto', 'fecha', 'totalPagado'));
    }

    /**
     * Mostrar formulario para registrar un pago.
     */
    public function create()
    {
        $empleados = Empleado::where('estado', 'Activo')->orderBy('nombre')->get();

        return view('pagos.crear', compact('empleados'));
    }

    /**
     * Guardar un nuevo pago.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'fecha' => 'required|date',
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|string|max:100',
            'comprobante' => 'nullable|string|max:100',
            'notas' => 'nullable|string|max:1000',
        ]);

        $pago = Pago::create($datos);

        return redirect()->route('pagos.ver', $pago)
            ->with('success', 'Pago registrado correctamente.');
    }

    /**
     * Ver comprobante detallado de un pago.
     */
    public function show(Pago $pago)
    {
        $pago->load('empleado');

        return view('pagos.ver', compact('pago'));
    }

    /**
     * Mostrar formulario para editar un pago.
     */
    public function edit(Pago $pago)
    {
        $empleados = Empleado::orderBy('nombre')->get();

        return view('pagos.editar', compact('pago', 'empleados'));
    }

    /**
     * Actualizar los datos de un pago.
     */
    public function update(Request $request, Pago $pago)
    {
        $datos = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'fecha' => 'required|date',
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|string|max:100',
            'comprobante' => 'nullable|string|max:100',
            'notas' => 'nullable|string|max:1000',
        ]);

        $pago->update($datos);

        return redirect()->route('pagos.index')
            ->with('success', 'Pago actualizado correctamente.');
    }

    /**
     * Eliminar un registro de pago.
     */
    public function destroy(Pago $pago)
    {
        $pago->delete();

        return redirect()->route('pagos.index')
            ->with('success', 'Registro de pago eliminado.');
    }
}
