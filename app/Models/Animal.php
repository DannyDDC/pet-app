<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $table = "animales";
    protected $fillable = [
        'id',
        'nombre',
        'anios',
        'meses',
        'altura',
        'peso',
        'color',
        'vacunado',
        'ruta_imagen',
        'tipo_animal_id',
        'user_id'
    ];

    protected $perPage = 50;
    protected $primaryKey = 'id';
    public $incrementing = false; 

    public function getIdAttribute($value)
    {
      return (string)$value;
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');         
    }
}
