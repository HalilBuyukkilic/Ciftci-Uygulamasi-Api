<?php

namespace App\Models\Ozellik;

use App\Models\Kategoriler\KategoriOzellik;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ozellik extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ozellikler';
    protected $guarded = [];

    public function secenekler()
    {
        return $this->hasMany(OzellikSecenek::class, 'ozellik_id', 'id');
    }

    public function kategoriOzellik()
    {
        return $this->hasMany(KategoriOzellik::class, 'kategori_id', 'id');
    }
}
