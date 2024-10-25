<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Cliente extends Eloquent
{
    protected $connection = 'mongodb'; // Conexión a MongoDB
    protected $collection = 'clientes'; // Nombre de la colección

    // Atributos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'barrio',
        'direccion',
        'telefono',
        'fechaAdquisicion', // Fecha de adquisición
        'productos',        // Array de productos
        'valorTotalAPagar', // Valor total a pagar
        'abonos',           // Array de abonos
        'totalAbonos',      // Suma total de abonos
        'valorFinal'        // Valor final después de los abonos
    ];

    // Estructuras JSON o arrays que se almacenan como tal en MongoDB
    protected $casts = [
        'fechaAdquisicion' => 'datetime',
        'productos' => 'array',
        'abonos' => 'array',
    ];
}
