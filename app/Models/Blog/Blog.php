<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'bloglar';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(BlogKategori::class, 'kategori_id', 'id');
    }
}
