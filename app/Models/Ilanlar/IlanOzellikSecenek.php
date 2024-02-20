<?php

namespace App\Models\Ilanlar;

use App\Models\Ozellik\Ozellik;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IlanOzellikSecenek extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ilan_ozellik_secenekleri';

    public function ilan()
    {
        return $this->belongsTo(Ilan::class, 'ilan_id', 'id');
    }

    public function ozellik()
    {
        return $this->belongsTo(Ozellik::class, 'ozellik_id', 'id');
    }
}
