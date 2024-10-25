<?php

namespace App\Http\Controllers;

use App\Models\Abono;
use Illuminate\Http\Request;

class AbonoController extends Controller
{
    // Listar todos los abonos
    public function index()
    {
        $abonos = Abono::with('productos')->get();  // Incluye los productos relacionados con cada abono
        return response()->json($abonos);
    }

    // Crear un nuevo abono
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,_id', // Validar que el cliente exista
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,_id', // Validar que el producto exista
            'productos.*.cantidad' => 'required|integer|min:1',
            'monto' => 'required|numeric|min:0', // Cambié 'monto_abonado' a 'monto' según el modelo
            'fecha' => 'required|date',
        ]);

        // Crear el abono
        $abono = new Abono([
            'cliente_id' => $request->cliente_id,
            'monto' => $request->monto, // Cambié 'monto_abonado' a 'monto'
            'fecha' => $request->fecha,
        ]);

        $abono->save();

        // Asociar productos al abono
        foreach ($request->productos as $producto) {
            $abono->productos()->attach($producto['producto_id'], ['cantidad' => $producto['cantidad']]);
        }

        return response()->json($abono, 201);
    }

    // Mostrar un abono específico
    public function show($id)
    {
        $abono = Abono::with('productos')->find($id);

        if (!$abono) {
            return response()->json(['message' => 'Abono no encontrado'], 404);
        }

        return response()->json($abono);
    }

    // Actualizar un abono
    public function update(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0', // Cambié 'monto_abonado' a 'monto'
            'fecha' => 'required|date',
        ]);

        $abono = Abono::find($id);

        if (!$abono) {
            return response()->json(['message' => 'Abono no encontrado'], 404);
        }

        $abono->update($request->all());
        return response()->json($abono);
    }

    // Eliminar un abono
    public function destroy($id)
    {
        $abono = Abono::find($id);

        if (!$abono) {
            return response()->json(['message' => 'Abono no encontrado'], 404);
        }

        $abono->delete();
        return response()->json(['message' => 'Abono eliminado'], 204);
    }
}
