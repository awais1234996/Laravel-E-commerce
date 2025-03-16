<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'product_stock' => 'required',
            'status' => 'required',

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
        ];
    }
}
