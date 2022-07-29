<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = "solicitudes";
    protected $fillable = [
        'nombre',
        'correo_electronico',
        'telefono',
        'direccion',
        'ciudad',
        'motivo',
        'animal_id'
    ];
}
