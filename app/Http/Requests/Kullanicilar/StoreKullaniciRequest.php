<?php

namespace App\Http\Requests\Kullanicilar;

use Illuminate\Foundation\Http\FormRequest;

class StoreKullaniciRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|min:8|max:50|confirmed',
            'tel_no' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'İsim ve soyisim alanı gereklidir.',
            'email.required' => 'E-posta alanı gereklidir.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresine ait bir hesap bulunmaktadır.',
            'password.required' => 'Şifre gereklidir.',
            'password.min' => 'Şifre en az 8 karakter uzunluğunda olmalıdır.',
            'password.max' => 'Şifre en fazla 50 karakter uzunluğunda olmalıdır.',
            'password.confirmation' => 'Şifreler eşleşmiyor.',
            'tel_no.required' => 'Telefon gereklidir.'
        ];
    }
}
