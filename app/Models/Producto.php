<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Producto extends Eloquent
{
    protected $connection = 'mongodb'; // Especificar la conexión a MongoDB
    protected $collection = 'productos'; // Nombre de la colección

    // Atributos rellenables
    protected $fillable = [
        'nombre',
        'valorUnitario',
        'cantidad',
        'valorTotal',
    ];

    // Método para reducir el stock cuando se realiza un abono
    public function reducirStock(int $cantidad)
    {
        $this->cantidad -= $cantidad;
        $this->save();
    }
}
