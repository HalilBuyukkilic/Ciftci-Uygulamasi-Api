<?php

namespace App\Http\Controllers\Admin\Kullanici;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kullanicilar\ProfilFotoGuncelleRequest;
use App\Http\Requests\Kullanicilar\SifreGuncelleRequest;
use App\Http\Requests\Kullanicilar\StoreKullaniciRequest;
use App\Http\Requests\Kullanicilar\UpdateKullaniciRequest;
use App\Http\Resources\UI\Kullanici\KullaniciCollection;
use App\Http\Resources\UI\Kullanici\KullaniciResource;
use App\Models\Kullanicilar\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function response;


class KullaniciController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $kullanicilar = User::query();
        $count = $kullanicilar->count();
        $kullanicilar->role('Kullanici');
        if (isset($request->sortColumn) && isset($request->sorting))
        {
            $kullanicilar->orderBy($request->sortColumn, $request->sorting);
        }
        else
        {
            $kullanicilar->orderBy('id', 'desc');
        }
        if(isset($request->page) && isset($request->pageSize))
        {
            $kullanicilar->forPage($request->page+1, $request->pageSize);
        }
        return response()->json(['data' => new KullaniciCollection($kullanicilar->get()), 'totalCount' => $count]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
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

    /**
     * Display the specified resource.
     *
     * @param User $kullanici
     * @return KullaniciResource
     */
    public function show(User $kullanici)
    {
        return new KullaniciResource($kullanici);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateKullaniciRequest $request
     * @param User $kullanici
     * @return JsonResponse
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param User $kullanici
     * @return JsonResponse
     */
    public function destroy(User $kullanici)
    {
        $kullanici->durum = 0;
        if ($kullanici->update())
        {
            return response()->json(['status' => true], 200);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }
}
