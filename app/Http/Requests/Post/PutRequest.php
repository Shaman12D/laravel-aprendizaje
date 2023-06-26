<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PutRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator) {
        if ($this->expectsJson())
        {
            $response = new Response($validator->errors(),422);
            throw new ValidationException($validator, $response);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            "title"=>"required|min:5|max:500",
            "slug"=>"min:5|max:500|unique:posts,slug,".$this->route("post")->id,
            "content"=>"required|min:7",
            "category_id"=>"required|integer",
            "description"=>"required|min:7",
            "posted"=>"required",
            "image" => "mimes:jpeg,jpg,png|max:10240"
        ];
    }
}
