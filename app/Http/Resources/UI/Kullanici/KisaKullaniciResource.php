<?php

namespace App\Http\Resources\UI\Kullanici;

use Illuminate\Http\Resources\Json\JsonResource;

class KisaKullaniciResource extends JsonResource
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
            'tel_no' => $this->tel_no,
            'uyelik_tarihi' => $this->created_at
        ];
    }
}
