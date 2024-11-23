<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class LoginRequest.
 */
class LoginRequest extends Request
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

    public function attributes()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    public function rules()
    {
        return [
            'email' => 'required|email|max:155',
            'password' => 'required|max:16',
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
