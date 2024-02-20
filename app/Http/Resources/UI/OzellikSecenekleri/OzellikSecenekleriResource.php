<?php

namespace App\Http\Resources\UI\OzellikSecenekleri;

use Illuminate\Http\Resources\Json\JsonResource;

class OzellikSecenekleriResource extends JsonResource
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
            'secenek_adi' => $this->secenek_adi
        ];
    }
}
