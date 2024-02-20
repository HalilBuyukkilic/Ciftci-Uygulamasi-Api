<?php

namespace App\Http\Resources\UI\Ilan;

use Illuminate\Http\Resources\Json\JsonResource;

class KisaIlanResource extends JsonResource
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
            'fiyat' => format($this->fiyat),
            'il_ilce' => $this->il->city.'/'.$this->ilce->district,
            'tarih' => $this->tarih,
            'resim' => new IlanResimleriResource($this->resimler->where('vitrin', 1)->first())
        ];
    }
}
