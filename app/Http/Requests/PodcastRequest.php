<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PodcastRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'file_path'=>'required',
            'cover_image'=>'nullable',//i have some changes here ,
            'user_id'=>'required',
            'publish_at'=>'required',

          
        ];
    }
}
