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

    
}
