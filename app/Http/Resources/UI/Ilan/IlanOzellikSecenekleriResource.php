<?php

namespace App\Http\Resources\UI\Ilan;

use Illuminate\Http\Resources\Json\JsonResource;

class IlanOzellikSecenekleriResource extends JsonResource
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
            'id' => $this->ozellik->id,
            'ozellik' => $this->ozellik->ozellik_adi,
            'deger' => $this->deger,
            'tip' => $this->ozellik->secenekler->isEmpty()? 'input' : 'select'
        ];
    }
}
