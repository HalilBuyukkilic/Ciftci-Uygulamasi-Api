<?php

namespace App\Http\Resources\UI\Ozellik;

use App\Http\Resources\Admin\Ozellik\OzelliklerResource;
use App\Http\Resources\UI\OzellikSecenekleri\OzellikSecenekleriCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class OzellikResource extends JsonResource
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
            'ozellik_adi' => $this->ozellik->ozellik_adi,
            'secenekler' => new OzellikSecenekleriCollection($this->sec)
        ];
    }
}
