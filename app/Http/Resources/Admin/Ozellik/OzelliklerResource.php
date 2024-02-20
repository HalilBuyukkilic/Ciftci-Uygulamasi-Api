<?php

namespace App\Http\Resources\Admin\Ozellik;

use Illuminate\Http\Resources\Json\JsonResource;

class OzelliklerResource extends JsonResource
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
            'ozellik_adi' => $this->ozellik_adi
        ];
    }
}
