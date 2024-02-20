<?php

namespace App\Http\Resources\UI\Favori;

use App\Http\Resources\UI\Ilan\IlanResimleriResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriResource extends JsonResource
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
            'ilan_id' => $this->ilan->id,
            'baslik' => $this->ilan->baslik,
            'fiyat' => format($this->ilan->fiyat),
            'il_ilce' => $this->ilan->il->city . '/' . $this->ilan->ilce->district,
            'tarih' => $this->ilan->tarih,
            'resim' => new IlanResimleriResource($this->ilan->resimler->where('vitrin', 1)->first())
        ];
    }
}
