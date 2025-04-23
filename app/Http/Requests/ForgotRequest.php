<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            'token'=>'required',
            'email'=> 'required |email|string',
            'password'=>'required|string|min:6|confirmed'
        ];
    }
}
