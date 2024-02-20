<?php

namespace App\Models\Ilanlar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DopingliIlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dopingli_ilan';

    public function ilan()
    {
        return $this->belongsTo(Ilan::class, 'ilan_id', 'id');
    }
}
