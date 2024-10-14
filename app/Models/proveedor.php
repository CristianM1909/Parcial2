<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'telefono' , 'correo']; //DENTRO DE LOS CORCHETES SE PONE CON LOS CAMPOS QUE VAMOS A TRABAJAR, Tambien añadir el campo de la otra tabla con la que se va a relacionar


    public function compras(){
        return $this->hasMany(compra::class, 'id'); //colocar el id de la tabla principal
    }
}
