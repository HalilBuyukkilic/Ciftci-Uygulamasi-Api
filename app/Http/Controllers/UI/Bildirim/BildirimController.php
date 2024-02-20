<?php

namespace App\Http\Controllers\UI\Bildirim;

use App\Http\Controllers\Controller;
use App\Http\Resources\UI\Bildirim\BildirimCollection;
use App\Models\Bildirimler\Bildirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BildirimController extends Controller
{
    public function bildirimler()
    {
        $bildirimler = Bildirim::where('kullanici_id', Auth::id())->get();
        return response()->json(['data' => new BildirimCollection($bildirimler)]);
    }

    public function bildirimSonuc()
    {
        $bildirimler = Bildirim::where('kullanici_id', Auth::id())->where('okundu', 0)->get();
        return response()->json(['kalan' => $bildirimler->count()]);
    }
    public function okundu(Bildirim $bildirim)
    {
        if ($bildirim->update(['okundu' => 1])) {
            return response()->json(['status' => true], 200);
        } else {
            return response()->json(['status' => false], 400);
        }
    }
}
