<?php

namespace App\Http\Controllers\Admin\Ozellik;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kategori\StoreOzelliklerRequest;
use App\Http\Requests\Kategori\UpdateOzelliklerRequest;
use App\Http\Resources\Admin\Ozellik\OzelliklerCollection;
use App\Http\Resources\Admin\Ozellik\OzelliklerResource;
use App\Models\Ozellik\Ozellik;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function response;

class OzelliklerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(new OzelliklerCollection(Ozellik::get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(StoreOzelliklerRequest $request)
    {
        if (Ozellik::create($request->all()))
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
     * @param Ozellik $ozellik
     * @return OzelliklerResource
     */
    public function show(Ozellik $ozellik)
    {
        return new OzelliklerResource($ozellik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOzelliklerRequest $request
     * @param Ozellik $ozellik
     * @return JsonResponse
     */
    public function update(UpdateOzelliklerRequest $request, Ozellik $ozellik)
    {
        if ($ozellik->fill($request->all())->update())
        {
            return response()->json(['status' => true], 201);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ozellik $ozellik
     * @return JsonResponse
     */
    public function destroy(Ozellik $ozellik)
    {
        if ($ozellik->secenekler()->delete() && $ozellik->kategoriOzellik()->delete())  //daha güvenli bir yol bulunmalı belki de silinmemeli
        {
            return response()->json(['status' => true], 200);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }
}
