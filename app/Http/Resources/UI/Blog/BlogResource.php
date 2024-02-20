<?php

namespace App\Http\Resources\UI\Blog;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'baslik' => $this->baslik,
            'slug' => $this->slug,
            'bolge' => $this->bolge,
            'icerik' => $this->icerik,
            'gorsel' => $this->gorsel,
            'durum' => $this->durum
        ];
    }
}
