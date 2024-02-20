<?php

namespace App\Models\Ozellik;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OzellikSecenek extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ozellik_secenekleri';

    public function ozellik()
    {
        return $this->belongsTo(Ozellik::class, 'ozellik_id', 'id');
    }
}
