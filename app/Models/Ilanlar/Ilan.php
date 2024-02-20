<?php

namespace App\Models\Ilanlar;

use App\Models\Cities\Cities;
use App\Models\Cities\Districts;
use App\Models\Kategoriler\Kategori;
use App\Models\Kullanicilar\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ilan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ilanlar';

    protected $guarded = [];

    public function ozellikler()
    {
        return $this->hasMany(IlanOzellikSecenek::class, 'ilan_id', 'id');
    }

    public function resimler()
    {
        return $this->hasMany(IlanResim::class, 'ilan_id', 'id');
    }

    public function dopingler()
    {
        return $this->hasMany(DopingliIlan::class, 'ilan_id', 'id');
    }

    public function kullanici()
    {
        return $this->belongsTo(User::class, 'kullanici_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function il()
    {
        return $this->belongsTo(Cities::class, 'il_id', 'id');
    }

    public function ilce()
    {
        return $this->belongsTo(Districts::class, 'ilce_id', 'id');
    }
}
