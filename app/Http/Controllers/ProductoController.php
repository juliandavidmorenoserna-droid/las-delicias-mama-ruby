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
     * Guardar un nuevo producto en el inventario.
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

        return redirect()->route('inventario.index')
            ->with('success', 'Producto registrado correctamente en el inventario.');
    }

    /**
     * Mostrar la información detallada de un producto.
     */
    public function show(Producto $producto)
    {
        return view('inventario.ver', compact('producto'));
    }

    /**
     * Mostrar el formulario para editar un producto.
     */
    public function edit(Producto $producto)
    {
        return view('inventario.editar', compact('producto'));
    }

    /**
     * Actualizar los datos de un producto en el inventario.
     */
    public function update(Request $request, Producto $producto)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:0',
            'unidad' => 'required|string|max:255',
            'stock_minimo' => 'required|numeric|min:0',
        ]);

        $producto->update($datos);

        return redirect()->route('inventario.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar un producto del inventario.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('inventario.index')
            ->with('success', 'Producto eliminado correctamente del inventario.');
    }
}