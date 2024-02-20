<?php

namespace App\Models\Ilanlar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IlanResim extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='ilan_resimleri';

    public function ilan() {
        return $this->belongsTo(Ilan::class, 'ilan_id', 'id');
    }
}
