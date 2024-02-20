<?php

namespace App\Http\Resources\UI\Kategori;

use Illuminate\Http\Resources\Json\JsonResource;

class UIKategoriResource extends JsonResource
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
            'kategori_adi' => $this->kategori_adi,
            'slug' => $this->slug,
            'sira' => $this->sira,
            'alt_kategoriler' => new UIKategoriCollection($this->whenLoaded('altKategoriler')),
        ];
    }
}
