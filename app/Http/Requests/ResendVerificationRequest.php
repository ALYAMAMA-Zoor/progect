<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResendVerificationRequest extends FormRequest
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
            'email'=>'required|string|email',
            'password'=>' required|string|min:8|',
            'verification_code'=>'hhh'
        ];
    }
}
