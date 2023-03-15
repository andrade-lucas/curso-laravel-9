<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'string|required',
            'email'     => 'email|required',
            'password'  => 'string|required',
            'street'  => 'string',
            'number'  => 'string'
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'Esse campo é obrigatório',
            'email'     => 'Esse campo deve ser um email',
            'string'    => 'Esse campo precisa ser uma string'
        ];
    }
}
