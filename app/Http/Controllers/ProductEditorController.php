<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\DataTables\ProductsDataTableEditor;

class ProductEditorController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('dashboard.product.view_product');
    }

    public function store(ProductsDataTableEditor $editor)
    {
        return $editor->process(request());
    }
}
