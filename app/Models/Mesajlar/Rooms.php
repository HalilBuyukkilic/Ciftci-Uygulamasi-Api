<?php

namespace App\Models\Mesajlar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $table = 'websocket_room_ids';
    protected $fillable = ['user_id', 'receiver_id', 'room_id', 'ilan_id'];

    public function ilan()
    {
        return $this->hasMany(Ilan::class, 'ilan_id', 'id');
    }
}
