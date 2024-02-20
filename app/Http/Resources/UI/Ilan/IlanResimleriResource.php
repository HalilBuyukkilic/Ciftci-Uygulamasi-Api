<?php

namespace App\Http\Resources\UI\Ilan;

use Illuminate\Http\Resources\Json\JsonResource;

class IlanResimleriResource extends JsonResource
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
            'resim_yolu' => $this->resim_yolu,
            'sira' => $this->sira,
            'vitrin' => $this->vitrin
        ];
    }
}
