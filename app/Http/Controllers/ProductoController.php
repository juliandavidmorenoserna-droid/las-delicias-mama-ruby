<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Mostrar todos los productos del inventario.
     */
    public function index()
    {
        $productos = Producto::orderBy('nombre')->get();

        return view('inventario.index', compact('productos'));
    }

    /**
     * Mostrar el formulario para registrar un producto.
     */
    public function create()
    {
        return view('inventario.crear');
    }

    /**
     * Guardar un nuevo producto.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:0',
            'unidad' => 'required|string|max:255',
            'stock_minimo' => 'required|numeric|min:0',
        ]);

        Producto::create($datos);

        return redirect('/inventario')
            ->with('success', 'Producto registrado correctamente.');
    }
}