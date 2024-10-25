<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Abono extends Eloquent
{
    protected $connection = 'mongodb'; // Especificar la conexión a MongoDB
    protected $collection = 'abonos'; // Nombre de la colección

    protected $fillable = [
        'monto', // Cambié 'total' a 'monto' para que sea consistente con la interfaz
        'fecha',
        'cliente_id', // Este campo relaciona el abono con un cliente
        'productos', // Lista de productos asociados al abono (puedes modificar esto si lo necesitas)
    ];

    // Relación: Un abono pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relación: Un abono puede tener varios productos
    public function productos()
    {
        return $this->belongsToMany(Producto::class, null, 'abono_id', 'producto_id')
                    ->withPivot('cantidad');
    }
}
