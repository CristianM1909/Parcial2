<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'estado'];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'products_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'products_id');
    }
}
