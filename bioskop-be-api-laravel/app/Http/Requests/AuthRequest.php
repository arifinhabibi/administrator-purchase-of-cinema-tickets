<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'The Username must be filled !',
            'username.string' => 'The Username must be a string'
        ];
    }
}
