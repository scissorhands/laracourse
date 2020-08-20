<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
            'title' => 'required|max:64',
            'content' => 'required|max:128',
            'thumbnail' => 'image|mimes:jpeg,png,gif,svg,jpg|max:1024|dimensions:min_height=500,min_width=500'
        ];
    }
}
