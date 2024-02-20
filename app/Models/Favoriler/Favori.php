<?php

namespace App\Models\Favoriler;

use App\Models\Kullanicilar\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'favoriler';

    public function kullanici()
    {
        return $this->belongsTo(User::class, 'kullanici_id', 'id');
    }
}
