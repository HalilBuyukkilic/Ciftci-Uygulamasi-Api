<?php

namespace App\Models\Mesajlar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesaj extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = ['user_id', 'receiver_id', 'room_id', 'content', 'isSeens'];


    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
