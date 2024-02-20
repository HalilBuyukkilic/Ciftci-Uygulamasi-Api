<?php

namespace App\Http\Controllers\Admin\Kategori;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kategori\StoreKategoriRequest;
use App\Http\Requests\Kategori\UpdateKategoriRequest;
use App\Http\Resources\Admin\Kategori\KategoriCollection;
use App\Http\Resources\Admin\Kategori\KategoriResource;
use App\Models\Kategoriler\Kategori;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function response;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        if (!isset($request->kategori_id))
        {
            $kategoriler = Kategori::whereNull('ust_kategori')->get();
        }
        else
        {
            $kategoriler = Kategori::where('ust_kategori', $request->kategori_id)->get();
        }

        return response()->json(['data' => new KategoriCollection($kategoriler)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreKategoriRequest $request
     * @return JsonResponse
     */
    public function store(StoreKategoriRequest $request)
    {
        $kategori = new Kategori();
        $kategori->kategori_adi = $request->kategori_adi;
        $kategori->slug = Str::slug($request->kategori_adi);
        $kategori->ust_kategori = $request->ust_kategori;
        $kategori->sira = 1;
        if($kategori->save())
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
     * @param Kategori $kategori
     * @return KategoriResource
     */
    public function show(Kategori $kategori)
    {
        return new KategoriResource($kategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateKategoriRequest $request
     * @param Kategori $kategori
     * @return JsonResponse
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $kategori->kategori_adi = $request->kategori_adi;
        $kategori->slug = Str::slug($request->kategori_adi);
        $kategori->ust_kategori = $request->ust_kategori;
        $kategori->sira = $request->sira;
        if($kategori->update())
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
