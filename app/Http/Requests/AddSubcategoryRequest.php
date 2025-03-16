<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSubcategoryRequest extends FormRequest
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
        return [
           'subcategory_name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'subcategory_name.required' => 'Subcategory name is required',
            'category_id.required' => 'Category is required',
            'subcategory_description.required' => 'Subcategory description is required',
        ];
    }
}
