<?php

namespace App\Http\Requests\Kategori;

use Illuminate\Foundation\Http\FormRequest;

class StoreOzelliklerRequest extends FormRequest
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
            'ozellik_adi' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'ozellik_adi.required' => 'Özellik adı gereklidir.'
        ];
    }
}
