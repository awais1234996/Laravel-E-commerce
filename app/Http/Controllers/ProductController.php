<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Quantity;
use App\Models\Supplier;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\Http\Requests\AddProductRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $datatable, Request $request)
    {

        if ($request->ajax()) {
            $data = Product::with(['category', 'subcategory', 'supplier', 'quantity']);

            return DataTables::of($data)
            ->addIndexColumn()
                ->addColumn('category.name', function ($row) {
                    return  $row->category->category_name ;
                })
                ->addColumn('subcategory.name', function ($row) {
                    return  $row->subcategory->subcategory_name ;
                })
                ->addColumn('supplier.name', function ($row) {
                    return $row->supplier ? $row->supplier : 'N/A';
                })
                ->addColumn('quantity.amount', function ($row) {
                    return $row->quantity ? $row->quantity : 'N/A';
                })
                ->addColumn('product_image', function ($row) {
                    $images = unserialize($row->product_image);
                    return json_encode($images);
                })

                  ->addColumn('actions',function ($row) {
                        $editUrl = route('product.edit', $row->id);
                        $deleteUrl = route('product.destroy', $row->id);

                        return '<a href="' . $editUrl . '" data-id="' . $row->id . '" class="btn btn-sm btn-success">Edit</a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Delete</button>';
                    })

                ->setRowClass('{{ $id % 2 == 0 ? "alert-primary" : "alert-success" }}')
                ->setRowAttr(['align' => 'center'])
                ->rawColumns(['product_image', 'actions'])  // ->addColumn('actions',
                ->make(true);
        }

        return $datatable->render('dashboard.product.view_product');
    }






    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $subcategory = Subcategory::all();
        $supplier = Supplier::all();
        $quantity = Quantity::all();

        return view('dashboard.product.add_product', compact('category', 'subcategory', 'supplier', 'quantity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        $product = Product::where([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
        ])->first();

        if ($product) {
            return response()->json(['status' => 0, 'message' => 'Product Category Already Exist']);
        }

        $existCode = Product::where('product_name', $request->product_name)
            ->where('product_code', $request->product_code)
            ->first();

        if ($existCode) {
            return response()->json(['status' => 1, 'message' => 'Product Already Exist']);
        }

        $Images = [];
        if ($request->product_image) {
            foreach ($request->product_image as $pics) {
                $pictureName = uniqid() . "." . $pics->extension();
                $pics->move(public_path('product_images/'), $pictureName);
                $Images[] = $pictureName;
            }
            $pictures = serialize($Images);
        } else {
            return response()->json(['status' => 2, 'message' => 'Product Image issue']);
        }

        $sql = Product::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'supplier' => $request->supplier,
            'quantity' => $request->quantity,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'product_stock' => $request->product_stock,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
            'product_image' => $pictures,
            'status' => $request->status,
        ]);

        if ($sql) {
            return response()->json(['status' => 3, 'message' => 'Product Added Successfully']);
        } else {
            return response()->json(['status' => 4, 'message' => 'Product Not Added']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $category = Category::all();
        $subcategory = Subcategory::all();
        $supplier = Supplier::all();
        $quantity = Quantity::all();

        return view('dashboard.product.update_product', compact('product', 'category', 'subcategory', 'supplier', 'quantity'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->product_image) {
            $images = [];
            foreach ($request->product_image as $img) {
                $pictureName = uniqid() . "." . $img->extension();
                $img->move(public_path('product_images/'), $pictureName);
                $images[] = $pictureName;
            }
            if ($product->product_image) {
                $oldimages = unserialize($product->product_image);
                foreach ($oldimages as $oldimage) {
                    if (file_exists(public_path('product_images/' . $oldimage))) {
                        unlink(public_path('product_images/' . $oldimage));
                    }
                }
            }
            $pictures = serialize($images);
        } else {
            $pictures = $product->product_image;
        }

        $sql = Product::whereRaw('id=?', [$product->id])->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'supplier' => $request->supplier,
            'quantity' => $request->quantity,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'product_stock' => $request->product_stock,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
            'product_image' => $pictures,
            'status' => $request->status,
        ]);

        if ($sql) {
            return response()->json(['status' => 1, 'message' => 'Product Updated Successfully']);
        } else {
            return response()->json(['status' => 2, 'message' => 'Product Not Updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $pics = Product::whereRaw('id=?', [$product->id])->first();
        $product_images = unserialize($product->product_image);
        foreach ($product_images as $prpduct_image) {
            if (file_exists(public_path('product_images/' . $prpduct_image))) {
                unlink(public_path('product_images/' . $prpduct_image));
            }
        }


        $sql = Product::whereRaw('id=?', [$product->id])->delete();
        if ($sql) {
            return response()->json(['status' => 1, 'message' => 'Product Deleted Successfully']);
        } else {
            return response()->json(['status' => 2, 'message' => 'Product Not Deleted']);
        }
    }
}
