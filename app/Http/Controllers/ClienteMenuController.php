<?php

namespace App\Http\Controllers;

use App\Models\ProductoVenta;
use Illuminate\Http\Request;

class ClienteMenuController extends Controller
{
    /**
     * Mostrar la carta digital del restaurante a los clientes.
     */
    public function index(Request $request)
    {
        $buscar = $request->query('buscar');
        $categoriaSeleccionada = $request->query('categoria');

        $query = ProductoVenta::orderBy('categoria')->orderBy('nombre');

        if (!empty($buscar)) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('descripcion', 'like', "%{$buscar}%");
            });
        }

        if (!empty($categoriaSeleccionada)) {
            $query->where('categoria', $categoriaSeleccionada);
        }

        $productos = $query->get()->groupBy('categoria');
        $categorias = ProductoVenta::distinct()->pluck('categoria')->filter()->values();

        return view('cliente.menu', compact('productos', 'categorias', 'buscar', 'categoriaSeleccionada'));
    }
}
