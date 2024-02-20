<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UI\Kullanici\KullaniciResource;
use App\Models\Kullanicilar\User;
use Carbon\Carbon;
use function auth;
use function response;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if ($user = User::where('email', $request->email)->first())
        {
            if ($user->durum == 0)
            {
                return response()->json(['error' => 'Giriş bilgileri yanlış'], 401);
            }
        }

        if (!$token = auth()->attempt($request->validated()))
        {
            return response()->json(['error' => 'Giriş bilgileri yanlış'], 401);
        }

        return $this->createNewToken($token);
    }

    public function adminLogin(LoginRequest $request)
    {
        if ($user = User::where('email', $request->email)->first())
        {
            if ($user->durum == 0)
            {
                return response()->json(['error' => 'Giriş bilgileri yanlış'], 401);
            }
            if (!$user->hasrole('Admin'))
            {
                return response()->json(['error' => 'Yetkisiz giriş'], 403);
            }
        }

        if (!$token = auth()->attempt($request->validated()))
        {
            return response()->json(['error' => 'Giriş bilgileri yanlış'], 401);
        }

        return $this->createNewToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Çıkış yapıldı']);
    }

    public function validateToken()
    {
        if (auth()->check())
        {
            return response()->json(['status' => true], 200);
        }
        else
        {
            return response()->json(['status' => false], 401);
        }
    }

    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'expires_in' => Carbon::now()->addSeconds(auth()->factory()->getTTL() * 60)->format('Y-m-d H:i:s'),
            'user' => new KullaniciResource(auth()->user()),
            'user_role' => auth()->user()->roles->pluck('name')[0]
        ]);
    }
}
