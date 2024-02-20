<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ilanlar\Ilan;
use App\Models\Kullanicilar\User;

class DashboardController extends Controller
{
    public function index()
    {
        $aktif_ilan = Ilan::where('durum', 1)->count();
        $pasif_ilan = Ilan::where('durum', 0)->count();
        $aktif_uye = User::role('Kullanici')->where('durum', 1)->count();
        $pasif_uye = User::role('Kullanici')->where('durum', 0)->count();
        $arr = [
            'aktif_ilan' => $aktif_ilan,
            'pasif_ilan' => $pasif_ilan,
            'aktif_uye' => $aktif_uye,
            'pasif_uye' => $pasif_uye
        ];
        return response()->json(['data' => $arr]);
    }
}
