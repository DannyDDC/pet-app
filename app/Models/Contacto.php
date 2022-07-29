<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;
    protected $table = "contactos";
    protected $fillable = [
        'nombre',
        'identificacion',
        'direccion',
        'correo_electronico',
        'telefono',
        'ciudad',
        'sitio_web',
        'requisitos_previos'
    ];

    protected $perPage = 50;

    public function tipoAnimales()
    {
      return $this->belongsToMany(TipoAnimal::class)
          ->using(ContactoTipoAnimalPivot::class);            
    }
}
