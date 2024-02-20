<?php

namespace App\Http\Resources\UI\OzellikSecenekleri;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OzellikSecenekleriCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
