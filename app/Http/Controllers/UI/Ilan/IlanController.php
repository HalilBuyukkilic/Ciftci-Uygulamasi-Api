<?php

namespace App\Http\Controllers\UI\Ilan;

use App\Http\Controllers\Controller;
use App\Http\Requests\UI\Ilan\StoreIlanRequest;
use App\Http\Requests\UI\Ilan\UpdateIlanRequest;
use App\Http\Resources\UI\Ilan\IlanResource;
use App\Http\Resources\UI\Ilan\KisaIlanCollection;
use App\Models\Ilanlar\Ilan;
use App\Models\Ilanlar\IlanOzellikSecenek;
use App\Models\Ilanlar\IlanResim;
use App\Models\Kategoriler\Kategori;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class IlanController extends Controller
{
    public function index(Request $request)
    {
        $ilanlar = Ilan::query();
        if (isset($request->il))
        {
            $ilanlar->where('il_id', $request->il);
        }
        if (isset($request->ilce))
        {
            $ilanlar->where('ilce_id', $request->ilce);
        }

        return response()->json(['data' => new KisaIlanCollection(Ilan::get())]);
    }

    public function store(StoreIlanRequest $request)
    {
        $secenekler = $request->secenekler;
        if (gettype($secenekler) == "string")
        {
            $secenekler = json_decode($secenekler, true);
        }

        DB::transaction(function () use ($request, $secenekler) {
            $ilan = new Ilan();
            $ilan->kullanici_id = Auth::id();
            $ilan->baslik = $request->baslik;
            $ilan->kimden = $request->kimden;
            $ilan->slug = Str::slug($request->baslik);
            $ilan->tarih = date('Y-m-d');
            $ilan->kategori_id = $request->kategori_id;
            $ilan->aciklama = $request->aciklama;
            $ilan->fiyat = $request->fiyat;
            $ilan->il_id = $request->il_id;
            $ilan->ilce_id = $request->ilce_id;
            $ilan->adres = $request->adres;
            $ilan->sifir_ikinci = $request->sifir_ikinci;

            if ($ilan->save())
            {
                $ilan->update(['slug' => $ilan->slug.'-'.$ilan->id]);
                foreach ($secenekler as $row)
                {
                    $secenek = new IlanOzellikSecenek();
                    $secenek->ilan_id = $ilan->id;
                    $secenek->ozellik_id = $row['id'];
                    $secenek->deger = $row['deger'];
                    $secenek->save();
                }

                $i = 0;
                foreach ($request->allFiles() as $row)
                {
                    $custom_file_name = time() + $i . '-' . $row->getClientOriginalName();
                    $row->storeAs('public/ilan-fotolari', $custom_file_name);
                    $custom_file_name = url('storage/ilan-fotolari/' . $custom_file_name);

                    $ilanResim = new IlanResim();
                    $ilanResim->ilan_id = $ilan->id;
                    $ilanResim->resim_yolu = $custom_file_name;
                    $ilanResim->sira = $i+1;
                    $ilanResim->vitrin = $i == 0 ? 1 : 0;
                    $ilanResim->save();
                    $i++;
                }

                return response()->json(['status' => true], 201);
            }
            else
            {
                return response()->json(['status' => false], 400);
            }
        });
    }

    public function update(UpdateIlanRequest $request, Ilan $ilan)
    {
        $ilan->baslik = $request->baslik;
        $ilan->kimden = $request->kimden;
        $ilan->slug = Str::slug($request->baslik).'-'.$ilan->id;
        $ilan->aciklama = $request->aciklama;
        $ilan->fiyat = $request->fiyat;
        $ilan->il_id = $request->il_id;
        $ilan->ilce_id = $request->ilce_id;
        $ilan->adres = $request->adres;
        $ilan->sifir_ikinci = $request->sifir_ikinci;
        $ilan->onay = 0;
        $secenekler = $request->secenekler;
        if (gettype($secenekler) == "string")
        {
            $secenekler = json_decode($secenekler, true);
        }

        if ($ilan->update())
        {
            $ilan->ozellikler()->delete();

            foreach ($secenekler as $row)
            {
                $secenek = new IlanOzellikSecenek();
                $secenek->ilan_id = $ilan->id;
                $secenek->ozellik_id = $row['id'];
                $secenek->deger = $row['deger'];
                $secenek->save();
            }

            $i = 0;
            foreach ($request->allFiles() as $row)
            {
                $custom_file_name = time() + $i . '-' . $row->getClientOriginalName();
                $row->storeAs('public/ilan-fotolari', $custom_file_name);
                $custom_file_name = url('storage/ilan-fotolari/' . $custom_file_name);

                $ilanResim = new IlanResim();
                $ilanResim->ilan_id = $ilan->id;
                $ilanResim->resim_yolu = $custom_file_name;
                $ilanResim->sira = $i+1;
                $ilanResim->vitrin = $i == 0 ? 1 : 0;
                $ilanResim->save();
                $i++;
            }

            return response()->json(['status' => true], 200);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }

    public function show(Ilan $ilan)
    {
//        $ilan->tik_sayisi++;
//        $ilan->update();
        return response()->json(['data' => new IlanResource($ilan)]);
    }


    public function kategoriIlanlari(Kategori $kategori, Request $request)
    {
        $kategori_ids = [];
        if ($kategori->altKategoriler->isEmpty())
        {
            $ilanlar = Ilan::where('kategori_id', $kategori->id)->where('durum', 1); //->where('onay', 1)

            //Filtreleme
            if (isset($request->il))
            {
                $ilanlar->where('il_id', $request->il);
            }
            if (isset($request->ilce))
            {
                $ilanlar->where('ilce_id', $request->ilce);
            }
            if (isset($request->min_fiyat))
            {
                $ilanlar->where('fiyat', '>=', $request->min_fiyat);
            }
            if (isset($request->max_fiyat))
            {
                $ilanlar->where('fiyat', '<=', $request->max_fiyat);
            }

            //Sıralama
            if (isset($request->siralama))
            {
                switch ($request->siralama)
                {
                    case('once_dusuk_fiyat'):
                        $ilanlar->orderBy('fiyat', 'ASC');
                        break;
                    case('once_yuksek_fiyat'):
                        $ilanlar->orderBy('fiyat', 'DESC');
                        break;
                    case('once_eski_ilan'):
                        $ilanlar->orderBy('tarih', 'ASC');
                        break;
                    case('once_yeni_ilan'):
                        $ilanlar->orderBy('tarih', 'DESC');
                        break;
                }
            }

            return response()->json(['data' => new KisaIlanCollection($ilanlar->get())]);
        }

        foreach ($kategori->altKategoriler as $row)
        {
            if (!$row->altKategoriler->isEmpty())
            {
                foreach ($row->altKategoriler as $item)
                {
                    $kategori_ids[] = $item->id;
                }
            }
            else
            {
                $kategori_ids[] = $row->id;
            }
        }

        $ilanlar = Ilan::whereIn('kategori_id', $kategori_ids)->where('onay', 1)->where('durum', 1);
        $count = $ilanlar->count();

        //Filtreleme
        if (isset($request->il))
        {
            $ilanlar->where('il_id', $request->il);
        }
        if (isset($request->ilce))
        {
            $ilanlar->where('ilce_id', $request->ilce);
        }
        if (isset($request->min_fiyat))
        {
            $ilanlar->where('fiyat', '>=', $request->min_fiyat);
        }
        if (isset($request->max_fiyat))
        {
            $ilanlar->where('fiyat', '<=', $request->max_fiyat);
        }

        //Sıralama
        if (isset($request->siralama))
        {
            switch ($request->siralama)
            {
                case('once_dusuk_fiyat'):
                    $ilanlar->orderBy('fiyat', 'ASC');
                    break;
                case('once_yuksek_fiyat'):
                    $ilanlar->orderBy('fiyat', 'DESC');
                    break;
                case('once_eski_ilan'):
                    $ilanlar->orderBy('tarih', 'ASC');
                    break;

                case('once_yeni_ilan'):
                    $ilanlar->orderBy('tarih', 'DESC');
                    break;
            }
        }

        if(isset($request->page) && isset($request->pageSize))
        {
            $ilanlar->forPage($request->page+1, $request->pageSize);
        }

        return response()->json(['data' => new KisaIlanCollection($ilanlar->get()), 'totalCount' => $count]);
    }

    public function ilanYayin(Request $request, Ilan $ilan)
    {
        if ($ilan->kullanici_id == Auth::id())
        {
            if ($ilan->update(['durum' => $request->durum]))
            {
                return response()->json(['status' => true], 200);
            }
            else
            {
                return response()->json(['status' => false], 400);
            }
        }
        else
        {
            return response()->json(['status' => false, 'message' => 'Yetkisiz İşlem'], 403);
        }

    }
}
