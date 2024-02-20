<?php

namespace App\Models\Bildirimler;

use App\Models\Kullanicilar\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bildirim extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'bildirimler';

    public function kullanici()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
