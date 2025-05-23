<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

 
    public function rules(): array
    {
        return [
        'email'=>'required |string||email',
        'password'=>'required|string',
        'two_factor_code'=>'required_if:two_factor_expires_at,true',
        ];
    }
}
