<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'          => 'required',
            'email'         => 'required|email:rfc',
            'password'      => 'min:8|required_with:password_confirmation|same:password_confirmation|nullable',
            'password_confirmation'     => 'min:8|same:password|nullable',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required'  => 'O campo é obrigatório.',
            'email'     => 'Esse e-mail não é válido.',
            'min'       => 'O campo deve ter no mínimo :min caracteres.',
            'same'       => 'A senha não é igual.',
        ];
    }
}
