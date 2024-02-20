<?php

namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    public function districts()
    {
        return $this->hasMany(Districts::class, 'city_id', 'id');
    }
}
