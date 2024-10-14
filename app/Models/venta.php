<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion', 'clientes_id' , 'products_id']; //DENTRO DE LOS CORCHETES SE PONE CON LOS CAMPOS QUE VAMOS A TRABAJAR, Tambien añadir el campo de la otra tabla con la que se va a relacionar


    public function clientes(){
        return $this->belongsTo(cliente::class, 'clientes_id'); //El primer parametro es de 
    }

    public function productos(){
        return $this->belongsTo(product::class, 'products_id'); //El primer parametro es de 
    }

    // Evento que se dispara al crear una venta
    protected static function booted()
    {
        static::created(function ($venta) {
            $producto = $venta->productos;

            // Verificar si hay suficiente stock
            if ($producto->stock >= $venta->cantidad) {
                $producto->decrement('stock', $venta->cantidad);

                // Actualizar el estado del producto
                if ($producto->stock <= 0) {
                    $producto->update(['estado' => 0]);  // Desactivar producto si el stock es 0
                }
            } else {
                throw new \Exception('No hay suficiente stock disponible para realizar la venta.');
            }
        });
    }
}
