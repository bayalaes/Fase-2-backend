<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Listar todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    // Crear un nuevo cliente
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'barrio' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'fechaAdquisicion' => 'required|date',
            'productos' => 'array', // Cambiado a opcional
            'productos.*.nombre' => 'required_with:productos|string|max:255',
            'productos.*.valorUnitario' => 'required_with:productos|numeric',
            'productos.*.cantidad' => 'required_with:productos|integer',
            'productos.*.valorTotal' => 'required_with:productos|numeric',
            'valorTotalAPagar' => 'required|numeric',
            'abonos' => 'array',
            'abonos.*.monto' => 'required_with:abonos|numeric',
            'abonos.*.fecha' => 'required_with:abonos|date',
            'totalAbonos' => 'required|numeric',
            'valorFinal' => 'required|numeric',
        ]);

        // Crear el cliente con los datos validados
        $cliente = Cliente::create($request->all());

        return response()->json($cliente, 201);
    }

    // Mostrar un cliente específico
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        return response()->json($cliente);
    }

    // Actualizar un cliente
    public function update(Request $request, $id)
    {
        // Validación de los datos actualizados
        $request->validate([
            'nombre' => 'required|string|max:255',
            'barrio' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'fechaAdquisicion' => 'required|date',
            'productos' => 'array', // Cambiado a opcional
            'productos.*.nombre' => 'required_with:productos|string|max:255',
            'productos.*.valorUnitario' => 'required_with:productos|numeric',
            'productos.*.cantidad' => 'required_with:productos|integer',
            'productos.*.valorTotal' => 'required_with:productos|numeric',
            'valorTotalAPagar' => 'required|numeric',
            'abonos' => 'array',
            'abonos.*.monto' => 'required_with:abonos|numeric',
            'abonos.*.fecha' => 'required_with:abonos|date',
            'totalAbonos' => 'required|numeric',
            'valorFinal' => 'required|numeric',
        ]);

        // Buscar el cliente por su ID
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        // Actualizar el cliente con los nuevos datos
        $cliente->update($request->all());

        return response()->json($cliente);
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        // Buscar el cliente por su ID
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        // Eliminar el cliente
        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado'], 204);
    }
}
