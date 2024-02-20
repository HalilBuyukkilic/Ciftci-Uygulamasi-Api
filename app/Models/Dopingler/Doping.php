<?php

namespace App\Models\Dopingler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doping extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dopingler';
}
