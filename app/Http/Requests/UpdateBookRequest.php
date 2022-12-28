<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            "title" => "required|max:255",
            "chapter" => "required|max:255",
            "cover" => "mimetypes:image/jpeg,image/png|file|max:3500",
            "price" => "integer",
            "group_id" => "required|integer",
            "type" => "required|in:all,one",
        ];
    }
}
