<?php

namespace App\Http\Controllers\UI\Kategori;

use App\Http\Controllers\Controller;
use App\Http\Resources\UI\Kategori\AnaKategoriCollection;
use App\Http\Resources\UI\Kategori\UIKategoriCollection;
use App\Http\Resources\UI\Ozellik\OzellikCollection;
use App\Models\Kategoriler\Kategori;
use App\Models\Kategoriler\KategoriOzellik;
use App\Models\Ozellik\Ozellik;
use App\Models\Ozellik\OzellikSecenek;
use function response;


class UiKategoriController extends Controller
{
    public function index()
    {
        $dbkategoriler = Kategori::whereNull('ust_kategori')->orderBy('sira', 'asc')->get();
        return response()->json(['data' => new UIKategoriCollection($dbkategoriler->load('altKategoriler'))]);
    }

    public function anaKategoriler()
    {
        return response()->json(['data' => new AnaKategoriCollection(Kategori::whereNull('ust_kategori')->orderBy('sira', 'asc')->get())]);
    }

    public function altKategoriler(Kategori $kategori)
    {
        return response()->json(['data' => new AnaKategoriCollection(Kategori::where('ust_kategori', $kategori->id)->orderBy('sira', 'asc')->get()), 'kategori' => $kategori->kategori_adi, 'id' => $kategori->id]);
    }

    public function kategoriOzellikleri($id)
    {
        $ozellikler = KategoriOzellik::where('kategori_id', $id)->pluck('ozellik_id');
        $ozellikler = Ozellik::whereIn('id', $ozellikler)->get();

        $ozellikler->map(function ($row) use ($id) {
            $row->makeHidden(['created_at', 'updated_at', 'deleted_at']);
            $row->secenekler = OzellikSecenek::where('kategori_id', $id)->where('ozellik_id', $row->id)->get(['id', 'ozellik_id', 'secenek_adi']);
        });

        return response()->json(['data' => $ozellikler]);
    }

    public function breadCrumb(Kategori $kategori)
    {
        if (isset($kategori->ustKategori->ustKategori))
        {
            $breadcrumb[0] = [
                'id' => $kategori->ustKategori->ustKategori->id,
                'isim' => $kategori->ustKategori->ustKategori->kategori_adi,
                'slug' => $kategori->ustKategori->ustKategori->slug
            ];
            $breadcrumb[1] = [
                'id' => $kategori->ustKategori->id,
                'isim' => $kategori->ustKategori->kategori_adi,
                'slug' => $kategori->ustKategori->slug
            ];
            $breadcrumb[2] = [
                'id' => $kategori->id,
                'isim' => $kategori->kategori_adi,
                'slug' => $kategori->slug
            ];
        }
        elseif ($kategori->ustKategori)
        {
            $breadcrumb[0] = [
                'id' => $kategori->ustKategori->id,
                'isim' => $kategori->ustKategori->kategori_adi,
                'slug' => $kategori->ustKategori->slug
            ];
            $breadcrumb[1] = [
                'id' => $kategori->id,
                'isim' => $kategori->kategori_adi,
                'slug' => $kategori->slug
            ];
        }
        else
        {
            $breadcrumb[0] = [
                'id' => $kategori->id,
                'isim' => $kategori->kategori_adi,
                'slug' => $kategori->slug
            ];
        }
        return response()->json(['data' => $breadcrumb]);
    }

}
