<?php

namespace App\Http\Requests\UI\Ilan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kategori_id' => 'required',
            'baslik' => 'required',
            'fiyat' => 'required',
            'il_id' => 'required',
            'ilce_id' => 'required',
        ];
    }
}
