<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Add_POS_Product;
use Illuminate\Support\Facades\Auth;

class AddPOSProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::paginate(5, ['*'], 'products_page');
        $pos = Add_POS_Product::paginate(5, ['*'], 'pos_page');


        return view('dashboard.POS.addPOSProduct', compact('products', 'pos'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = Add_POS_Product::all();
        $exist = $exist->where('product_code', $request->product_code)->first();
        if ($exist) {
            return response()->json(['status' => 0, 'message' => 'Product already added']);
        } else {
            $pos_email = Auth::user()->email;
            $up = $request->unit_price;
            $pq = $request->product_quantity;
            $total_price = $up * $pq;;

            $sql = Add_POS_Product::create([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_unit_price' => $request->unit_price,
                'product_quantity' => $request->product_quantity,
                'product_total_price' => $total_price,
                'pos_email' => $pos_email

            ]);
            if ($sql) {
                return response()->json(['status' => 1, 'message' => 'Product added successfully']);
            } else {
                return response()->json(['status' => 2, 'message' => 'Failed to add product']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $del = Add_POS_Product::truncate();

        if ($del) {

            return redirect()->back()->with('success', 'All Product deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete product');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Add_POS_Product $add_POS_Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $add_POS_Product)
    {
        $up = $request->unit_price;
        $pq = $request->pos_quantity;
        $total = $up * $pq;

        $sql = Add_POS_Product::where('id', $add_POS_Product)->update([
            'product_total_price' => $total,
            'product_quantity' => $request->pos_quantity
        ]);

        if ($sql) {
            return response()->json(['status' => 1, 'message' => 'Product updated successfully']);
        } else {
            return response()->json(['status' => 2, 'message' => 'Failed to update product']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $del = Add_POS_Product::where('id', $id)->delete();

        if ($del) {

            return redirect()->back()->with('success', 'Product deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete product');
        }
    }
}
