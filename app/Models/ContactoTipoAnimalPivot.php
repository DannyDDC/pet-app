<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ContactoTipoAnimalPivot extends Pivot
{
    protected $casts = [
        'value' => 'array',
    ]; 

    public function setTipoAnimalIdAttribute($value) {

        $this->attributes['tipo_animal_id'] = (string)$value;    
    }
}
