<?php

namespace App\Http\Controllers\Admin\Ilan;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Ilan\IlanCollection;
use App\Http\Resources\UI\Ilan\IlanResource;
use App\Models\Ilanlar\Ilan;
use Illuminate\Http\Request;

class IlanlarController extends Controller
{
    public function index(Request $request)
    {
        $ilanlar = Ilan::query();
        $count = $ilanlar->count();
        if (isset($request->sortColumn) && isset($request->sorting))
        {
            $ilanlar->orderBy($request->sortColumn, $request->sorting);
        }
        else
        {
            $ilanlar->orderBy('id', 'desc');
        }
        if(isset($request->page) && isset($request->pageSize))
        {
            $ilanlar->forPage($request->page+1, $request->pageSize);
        }

        return response()->json(['data' => new IlanCollection($ilanlar->get()), 'totalCount' => $count]);
    }

    public function show(Ilan $ilan)
    {
        return response()->json(['data' => new IlanResource($ilan)]);
    }

    public function ilanOnay(Request $request, Ilan $ilan)
    {
        if ($ilan->update(['onay' => $request->onay, 'durum' => 0]))
        {
            return response()->json(['status' => true], 200);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }

    public function ilanYayin(Request $request, Ilan $ilan)
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
}
