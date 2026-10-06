<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductoVenta;
use Illuminate\Http\Request;

class ProductoVentaController extends Controller
{
    /**
     * Mostrar todos los productos para la venta con opciones de búsqueda y filtro.
     */
    public function index(Request $request)
    {
        $buscar = $request->query('buscar');
        $categoria = $request->query('categoria');

        $query = ProductoVenta::with('inventario')->orderBy('nombre');

        if (!empty($buscar)) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('descripcion', 'like', "%{$buscar}%");
            });
        }

        if (!empty($categoria)) {
            $query->where('categoria', $categoria);
        }

        $productos = $query->get();

        // Obtener categorías únicas para el filtro
        $categorias = ProductoVenta::distinct()->pluck('categoria')->filter()->values();

        return view('productos.index', compact('productos', 'buscar', 'categoria', 'categorias'));
    }

    /**
     * Mostrar formulario para registrar un nuevo producto de venta.
     */
    public function create()
    {
        $insumosInventario = Producto::orderBy('nombre')->get();

        return view('productos.crear', compact('insumosInventario'));
    }

    /**
     * Guardar un nuevo producto para la venta.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
            'categoria' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'disponible' => 'required|boolean',
            'producto_id' => 'nullable|exists:productos,id',
        ]);

        ProductoVenta::create($datos);

        return redirect()->route('productos.index')
            ->with('success', 'Producto de venta registrado exitosamente.');
    }

    /**
     * Mostrar el detalle de un producto de venta.
     */
    public function show(ProductoVenta $producto)
    {
        $producto->load('inventario');

        return view('productos.ver', compact('producto'));
    }

    /**
     * Mostrar el formulario para editar un producto de venta.
     */
    public function edit(ProductoVenta $producto)
    {
        $insumosInventario = Producto::orderBy('nombre')->get();

        return view('productos.editar', compact('producto', 'insumosInventario'));
    }

    /**
     * Actualizar los datos de un producto de venta.
     */
    public function update(Request $request, ProductoVenta $producto)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
            'categoria' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'disponible' => 'required|boolean',
            'producto_id' => 'nullable|exists:productos,id',
        ]);

        $producto->update($datos);

        return redirect()->route('productos.index')
            ->with('success', 'Producto de venta actualizado exitosamente.');
    }

    /**
     * Eliminar un producto de venta.
     */
    public function destroy(ProductoVenta $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto de venta eliminado correctamente.');
    }
}
