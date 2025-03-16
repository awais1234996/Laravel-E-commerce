<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSupplierRequest extends FormRequest
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
            'supplier_name' => 'required',
            'supplier_email' => 'required',
            'supplier_cnic' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'supplier_name.required' => 'Supplier Name is required',
            'supplier_email.required' => 'Supplier Email is required',
            'supplier_cnic.required' => 'Supplier CNIC is required',
        ];
    }
}
