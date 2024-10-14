<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','description', 'precio','stock' , 'estado' ,]; //DENTRO DE LOS CORCHETES SE PONE CON LOS CAMPOS QUE VAMOS A TRABAJAR, Tambien añadir el campo de la otra tabla con la que se va a relacionar

    //protecter $guarded = []; tambien funciona para almacenar 


    //CREAR LA FUNCION QUE RELACIONE A NUESTRO MODELO
    public function ventas(){
        return $this -> hasMany(venta :: class, 'id');
    }

    public function compras(){
        return $this -> hasMany(compra :: class, 'id');
    }

     // Evento que se dispara antes de guardar o actualizar el producto
     protected static function booted()
     {
         static::saving(function ($product) {
             // Si el stock es 0 o menor, desactivar el estado
             if ($product->stock <= 0) {
                 $product->estado = 0;  // Desactivar si no hay stock
             } else {
                 $product->estado = 1;  // Reactivar si hay stock disponible
             }
         });
     }
}
