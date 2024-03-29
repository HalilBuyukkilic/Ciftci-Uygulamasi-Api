<?php

namespace App\Http\Requests\Kullanicilar;

use Illuminate\Foundation\Http\FormRequest;

class ProfilFotoGuncelleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4096'
        ];
    }
}
