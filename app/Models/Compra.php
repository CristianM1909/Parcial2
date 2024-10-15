<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['descripcion', 'proveedors_id', 'products_id', 'cantidad'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedors_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
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
