<?php

namespace App\Http\Requests\Kullanicilar;

use Illuminate\Foundation\Http\FormRequest;

class SifreGuncelleRequest extends FormRequest
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
            'password' => 'required|min:8|max:50|confirmed',
        ];
    }

    public function messages()
    {
        return[
            'password.required' =>'Lütfen Şifre Giriniz',
            'password.min' =>'Şifre En az 8 Karakterden Oluşmalıdır',
            'password.confirmation' => 'Şifreler Eşleşmelidir',
            'password.max' =>'Şifre En Fazla 50 Karakterden Oluşmalıdır',
        ];
    }
}
