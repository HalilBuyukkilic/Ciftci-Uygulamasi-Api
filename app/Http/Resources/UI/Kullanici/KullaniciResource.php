<?php

namespace App\Http\Resources\UI\Kullanici;

use Illuminate\Http\Resources\Json\JsonResource;

class KullaniciResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'tel_no' => $this->tel_no,
            'adres' => $this->adres,
            'durum' => $this->durum,
            'foto' => $this->profil_foto,
            'kayit_tarihi' => $this->created_at
        ];
    }
}
