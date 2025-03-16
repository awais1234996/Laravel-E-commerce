<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'supplier' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'total_price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'product_image' => 'required',
            'product_stock' => 'required',
            'status' => 'required',
            'product_image' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'Category is required',
            'subcategory_id.required' => 'Subcategory is required',
            'product_name.required' => 'Product Name is required',
            'supplier.required' => 'Supplier is required',
            'product_code.required' => 'Product Code is required',
            'quantity.required' => 'Quantity is required',
            'unit_price.required' => 'Unit Price is required',
            'total_price.required' => 'Total Price is required',
            'quantity.required' => 'Quantity is required',
            'description.required' => 'Description is required',
            'short_description.required' => 'Short Description is required',
            'product_stock.required' => 'Product Stock is required',
            'status.required' => 'Status is required',
            'product_image.required' => 'Product Image is required',
            // 'product_image.mimes' => 'Product Image must be png, jpg, jpeg, svg',
            // 'product_image.max' => 'Product Image must be less than 2MB',
        ];
    }
}
