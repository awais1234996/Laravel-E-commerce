<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\POS_UserInfo;
use Illuminate\Http\Request;
use App\Models\POS_OrderInfo;
use Illuminate\Support\Facades\Auth;

class POS_OrderInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = POS_OrderInfo::all();
        $exist = $exist->where('order_code', $request->product_code)->orWhere('order_invoice', $request->order_invoice)->first();
        if ($exist) {
            return response()->json(['status' => 0, 'message' => 'Product already added']);
        } else {


            $inv = $request->order_invoice;
            $pos_email = Auth::user()->email;
            $up = $request->unit_price;
            $pq = $request->product_quantity;
            $total_price = $up * $pq;;
            $sql = POS_OrderInfo::create([
                'order_invoice' => $inv,
                'order_product_name' => $request->product_name,
                'order_code' => $request->product_code,
                'order_unit_price' => $request->unit_price,
                'order_quantity' => $request->product_quantity,
                'order_total_price' => $total_price,
                'order_email' => $pos_email,


            ]);

            return response()->json(['status' => 1, 'message' => 'Product added successfully'])
                ??
                response()->json(['status' => 2, 'message' => 'Failed to add product']);;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $invoice)
    {
        POS_OrderInfo::where('order_invoice', $invoice)->delete();

        return redirect()->back()->with('success', 'Product deleted successfully') ?? redirect()->back()->with('error', 'Failed to delete product');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $up = $request->order_unit_price;
        $pq = $request->order_quantity;
        $total = $up * $pq;

        POS_OrderInfo::where('id', $id)->update([
            'order_total_price' => $total,
            'order_quantity' => $request->order_quantity
        ]);

        return response()->json(['status' => 1, 'message' => 'Product updated successfully']) ?? response()->json(['status' => 2, 'message' => 'Failed to update product']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        POS_OrderInfo::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Product deleted successfully') ?? redirect()->back()->with('error', 'Failed to delete product');;
    }
}
