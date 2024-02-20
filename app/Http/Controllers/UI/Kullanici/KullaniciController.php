<?php

namespace App\Http\Controllers\UI\Kullanici;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kullanicilar\ProfilFotoGuncelleRequest;
use App\Http\Requests\Kullanicilar\SifreGuncelleRequest;
use App\Http\Requests\Kullanicilar\StoreKullaniciRequest;
use App\Http\Requests\Kullanicilar\UpdateKullaniciRequest;
use App\Http\Resources\UI\Ilan\KisaIlanCollection;
use App\Http\Resources\UI\Kullanici\KullaniciResource;
use App\Models\Ilanlar\Ilan;
use App\Models\Kullanicilar\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KullaniciController extends Controller
{
    public function index()
    {
        return response()->json(new KullaniciResource(auth()->user()));
    }

    public function store(StoreKullaniciRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        unset($data['password_confirmation']);

        if (User::create($data))
        {
            return response()->json(['status' => true], 201);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }


    public function update(UpdateKullaniciRequest $request, User $kullanici)
    {
        $data = $request->all();
        if ($kullanici->fill($data)->update())
        {
            return response()->json(['status' => true], 200);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }


    public function sifreGuncelle(SifreGuncelleRequest $request)
    {
        $kullanici = Auth::user();
        $kullanici->password = Hash::make($request->password);
        if ($kullanici->update())
        {
            return response()->json(['status' => true], 200);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }

    public function profilFotoGuncelle(ProfilFotoGuncelleRequest $request)
    {
        $custom_file_name = time().'-'.$request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('public/kullanici', $custom_file_name);
        $custom_file_name = url('storage/kullanici/' . $custom_file_name);

        $kullanici = Auth::user();
        $kullanici->profil_foto = $custom_file_name;
        if ($kullanici->update())
        {
            return response()->json(['status' => true], 200);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }

    public function ilanlar(Request $request)
    {
        $ilanlar = Ilan::query();
        $ilanlar->where('kullanici_id', Auth::id());
        $count = $ilanlar->count();
        if(isset($request->page) && isset($request->pageSize))
        {
            $ilanlar->forPage($request->page+1, $request->pageSize);
        }

        return response()->json(['data' => new KisaIlanCollection($ilanlar->get()), 'totalCount' => $count]);
    }
}
