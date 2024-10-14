<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'telefono']; //DENTRO DE LOS CORCHETES SE PONE CON LOS CAMPOS QUE VAMOS A TRABAJAR, Tambien añadir el campo de la otra tabla con la que se va a relacionar

    //protecter $guarded = []; tambien funciona para almacenar 

    public function ventas(){
        return $this->hasMany(venta::class, 'id'); //colocar el id de la tabla principal
    }
}
