<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Listar todos los productos
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'valorUnitario' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'valorTotal' => 'required|numeric|min:0',
        ]);

        // Crear un nuevo producto usando los datos proporcionados
        $producto = Producto::create($request->all());
        return response()->json($producto, 201);
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'valorUnitario' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'valorTotal' => 'required|numeric|min:0',
        ]);

        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Actualizar el producto con los nuevos datos
        $producto->update($request->all());
        return response()->json($producto);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();
        return response()->json(['message' => 'Producto eliminado'], 204);
    }
}
