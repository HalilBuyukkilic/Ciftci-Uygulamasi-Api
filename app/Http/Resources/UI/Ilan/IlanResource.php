<?php

namespace App\Http\Resources\UI\Ilan;

use App\Http\Resources\UI\Il\IlResource;
use App\Http\Resources\UI\Ilce\IlceResource;
use App\Http\Resources\UI\Kategori\KisaKategoriResource;
use App\Http\Resources\UI\Kullanici\KisaKullaniciResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IlanResource extends JsonResource
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
            'kullanici' => new KisaKullaniciResource($this->kullanici),
            'kategori' => new KisaKategoriResource($this->kategori),
            'ilan_no' => $this->id,
            'baslik' => $this->baslik,
            'aciklama' => $this->aciklama,
            'fiyat' => format($this->fiyat),
            'tarih' => $this->tarih,
            'onay' => $this->onay,
            'durum' => $this->durum,
            'konum' => $this->konum,
            'il' => new IlResource($this->il),
            'ilce' => new IlceResource($this->ilce),
            'telefon_goster' => $this->telefon_goster,
            'goruntulu_arama' => $this->goruntulu_arama,
            'takas' => $this->takas,
            'kimden' => $this->kimden,
            'sifir_ikinci' => $this->sifir_ikinci,
            'resimler' => new IlanResimleriCollection($this->resimler),
            'ilan_ozellikleri' => new IlanOzellikSecenekleriCollection($this->ozellikler),
            'video' => $this->video
        ];
    }
}
