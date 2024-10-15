<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['descripcion', 'clientes_id', 'products_id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    // protected static function booted()
    // {
    //     static::created(function ($venta) {
    //         $product = $venta->products;

    //         // Verificar si hay suficiente stock
    //         if ($product->stock >= $venta->cantidad) {
    //             $product->decrement('stock', $venta->cantidad);

    //             // Actualizar el estado del producto
    //             if ($product->stock <= 0) {
    //                 $product->update(['estado' => 0]);  // Desactivar producto si el stock es 0
    //             }
    //         } else {
    //             throw new \Exception('No hay suficiente stock disponible para realizar la venta.');
    //         }
    //     });
    // }
}
