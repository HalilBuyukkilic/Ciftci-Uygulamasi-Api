<?php

namespace App\Models\Kategoriler;

use App\Models\Ozellik\Ozellik;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriOzellik extends Model
{
    use HasFactory;

    protected $table = 'kategori_ozellik';

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function ozellik()
    {
        return $this->belongsTo(Ozellik::class, 'ozellik_id', 'id');
    }
}
