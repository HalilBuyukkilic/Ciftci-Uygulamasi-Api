<?php

namespace App\Http\Resources\UI\Bildirim;

use Illuminate\Http\Resources\Json\JsonResource;

class BildirimResource extends JsonResource
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
            'type' => $this->type,
            'aciklama' => $this->aciklama,
            'zaman' =>  date('Y-m-d H:i:s', strtotime($this->zaman)),
            'okundu' => $this->okundu
        ];
    }
}
