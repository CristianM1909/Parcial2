<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'telefono', 'correo'];

    public function compras()
    {
        return $this->hasMany(Compra::class, 'proveedors_id');
    }
}
