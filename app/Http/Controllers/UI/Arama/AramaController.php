<?php

namespace App\Http\Controllers\UI\Arama;

use App\Http\Controllers\Controller;
use App\Http\Resources\UI\Ilan\KisaIlanCollection;
use App\Models\Ilanlar\Ilan;
use App\Models\Kategoriler\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AramaController extends Controller
{
    public function index(Request $request)
    {
        $search_query = $request->ara;
        if (!isset($search_query)) {
            return response()->json(['data' => []]);
        }
        $ilanlar = Ilan::where('baslik', 'LIKE', "%$search_query%")->where('durum', 1)->where('onay', 1)->get();
        $kategoriler = Kategori::where('kategori_adi', 'LIKE', "%$search_query%")->get();

        $sonuc = $ilanlar;

        $ids = [];
        foreach ($kategoriler as $row) {
            if ($row->altKategoriler->isEmpty()) {
                $ids[] = $row->id;
            } else {
                foreach ($row->altKategoriler as $item) {
                    if ($item->altKategoriler->isEmpty() && $item->altKategoriler->exists()) {
                        $ids[] = $item->id;
                    } else {
                        foreach ($item->altKategoriler as $k) {
                            $ids[] = $k->id;
                        }
                    }
                }
            }
        }

        $kategori_ilanlar = Ilan::whereIn('kategori_id', $ids)->where('durum', 1)->where('onay', 1)->get();
        foreach ($kategori_ilanlar as $row) {
            $sonuc->push($row);
        }
        $sonuc = $sonuc->unique('id');

        return response()->json(['data' => new KisaIlanCollection($sonuc)]);
    }
}
