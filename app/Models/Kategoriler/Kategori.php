<?php

namespace App\Models\Kategoriler;

use App\Models\Ozellik\Ozellik;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategoriler';
    protected $guarded = [];

    public function ozellikler()
    {
        return $this->hasMany(KategoriOzellik::class, 'kategori_id', 'id');
    }

    public function ozellikData()
    {
        return $this->hasManyThrough(Ozellik::class, KategoriOzellik::class, 'kategori_id', 'id', 'id', 'ozellik_id');
    }

    public function altKategoriler()
    {
        return $this->hasMany(Kategori::class, 'ust_kategori', 'id')->orderBy('sira');
    }

    public function ustKategori()
    {
        return $this->belongsTo(Kategori::class, 'ust_kategori', 'id');
    }


    public function root()
    {
        return $this->ustKategori ? $this->ustKategori->root() : $this;
    }
}
