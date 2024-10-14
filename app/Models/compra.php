<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion', 'proveedors_id' , 'products_id', 'cantidad']; //DENTRO DE LOS CORCHETES SE PONE CON LOS CAMPOS QUE VAMOS A TRABAJAR, Tambien añadir el campo de la otra tabla con la que se va a relacionar


    public function proveedors(){
        return $this->belongsTo(proveedor::class, 'proveedors_id'); //El primer parametro es de 
    }

    public function productos(){
        return $this->belongsTo(product::class, 'products_id'); //El primer parametro es de 
    }


    protected static function booted()
    {
        static::created(function ($compra) {
            $product = $compra->products;

            // Incrementar el stock
            $product->increment('stock', $compra->cantidad);

            // Si el stock es mayor a 0, reactivar el producto
            if ($product->stock > 0) {
                $product->update(['estado' => 1]);  // Reactivar producto si hay stock
            }
        });
    }
}
