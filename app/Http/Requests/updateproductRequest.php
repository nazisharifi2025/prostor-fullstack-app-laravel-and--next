<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class updateproductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "nullable|string:min:3",
              "stock" => "nullable|integer|min:1",
            "price" => "nullable|numeric|min:20",
            "brand" => "nullable|string|min:3",
            "description" => "nullable|string|min:10",
            "category" => "nullable|string|min:3",
            "img_url" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }
}
