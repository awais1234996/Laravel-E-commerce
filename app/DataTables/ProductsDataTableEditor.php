<?php

declare(strict_types=1);

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class ProductsDataTableEditor extends DataTablesEditor
{
    protected $model = Product::class;

    /**
     * Get create action validation rules.
     */
    public function createRules(): array
    {
        return [
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'supplier' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'total_price' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'status' => 'required',
            'product_image' => 'required',
            'product_stock' => 'required',

        ];
    }

    /**
     * Get edit action validation rules.
     */
    public function editRules(Model $model): array
    {
        return [
            'product_name' => 'sometimes|required|max:255',
            'product_code' => 'sometimes|required|max:255',
            'category_id' => 'sometimes|required',
            'subcategory_id' => 'sometimes|required',
            'supplier' => 'sometimes|required',
            'quantity' => 'sometimes|required',
            'unit_price' => 'sometimes|required',
            'total_price' => 'sometimes|required',
            'description' => 'sometimes|required',
            'short_description' => 'sometimes|required',
            'status' => 'sometimes|required',
            'product_image' => 'sometimes|required',
            'product_stock' => 'sometimes|required',

        ];
    }

    /**
     * Get remove action validation rules.
     */
    public function removeRules(Model $model): array
    {
        return [];
    }

    /**
     * Event hook that is fired after `creating` and `updating` hooks, but before
     * the model is saved to the database.
     */
    public function saving(Model $model, array $data): array
    {
        // Before saving the model, hash the password.

        return $data;
    }

    /**
     * Event hook that is fired after `created` and `updated` events.
     */
    public function saved(Model $model, array $data): Model
    {
        // do something after saving the model

        return $model;
    }

}
