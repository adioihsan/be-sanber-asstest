<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        if($this->routeIs("book.store"))
        return [
            'title' => 'required|max:255',
            'description'=>'required|max:1000',
            'image_url'=>'required|url:http,https|max:2083',
            'release_year'=>'required|numeric|min:1980|max:2021',
            'price'=>'required|max:255',
            'total_page'=>'required|numeric|max_digits:20',
            'category_id'=>'required|numeric|exists:categories,id',
        ];

        if($this->routeIs("book.update"))
        return [
            'title' => 'sometimes|max:255',
            'description'=>'sometimes|max:1000',
            'image_url'=>'sometimes|url:http,https|max:2083',
            'release_year'=>'sometimes|numeric|min:1980|max:2021',
            'price'=>'sometimes|max:255',
            'total_page'=>'sometimes|numeric|max_digits:20',
            'category_id'=>'sometimes|numeric|exists:categories,id',
        ];

    }
    
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->api_fail("validation errors",$validator->errors(),422));
    }

}
