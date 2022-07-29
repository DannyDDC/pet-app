<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUserPivot extends Pivot
{
    protected $casts = [
        'value' => 'array',
    ]; 

    public function setUserIdAttribute($value) {

        $this->attributes['user_id'] = (string)$value;    
    }
}
