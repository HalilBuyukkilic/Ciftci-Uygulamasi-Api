<?php

namespace App\Http\Resources\Admin\Ilan;

use App\Http\Resources\UI\Ilan\IlanResimleriResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'baslik' => $this->baslik,
            'kategori' => $this->kategori->kategori_adi,
            'tarih' => $this->tarih,
            'ekleyen' => $this->kullanici->name,
            'foto' => new IlanResimleriResource($this->resimler->where('vitrin', 1)->first()),
            'fiyat' => format($this->fiyat),
            'onay' => $this->onay
        ];
    }
}
