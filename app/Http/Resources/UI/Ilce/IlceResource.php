<?php

namespace App\Http\Resources\UI\Ilce;

use Illuminate\Http\Resources\Json\JsonResource;

class IlceResource extends JsonResource
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
            'ilce' => $this->district
        ];
    }
}
