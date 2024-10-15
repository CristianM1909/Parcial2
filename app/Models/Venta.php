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
}
