<?php

namespace App\Http\Controllers\UI\Favori;

use App\Http\Controllers\Controller;
use App\Models\Favoriler\Favori;
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    public function favoriler()
    {

    }

    public function favoriEkle(Request $request)
    {
        if (Favori::create($request->all()))
        {
            return response()->json(['status' => true], 201);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }
}
