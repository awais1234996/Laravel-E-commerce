<?php

namespace App\Http\Controllers;

use App\Models\POS_OrderInfo;
use App\Models\Product;
use App\Models\POS_UserInfo;
use App\Models\Add_POS_Product;
use Illuminate\Http\Request;

class POSUserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql = POS_UserInfo::query()->paginate(10);
        return view('dashboard.POS.view_POS', compact('sql'));
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



        $invoice = $request->invoice;

        $sql = POS_UserInfo::create([
            'invoice_number' => $invoice,
            'user_name' => $request->user_name,
            'contact' => $request->contact,
            'total_cash' => $request->total_cash,
            'status' => $request->status,
        ]);
        $fetch = Add_POS_Product::query()->get();
        if ($fetch->isEmpty()) {
            return response(['status' => 2, 'message' => 'No products found']);
        }

        foreach ($fetch as $product) {
            POS_OrderInfo::create([
                'order_invoice' => $invoice,
                'order_by' => $request->user_name,
                'order_product_name' => $product->product_name,
                'order_code' => $product->product_code,
                'order_unit_price' => $product->product_unit_price,
                'order_quantity' => $product->product_quantity,
                'order_total_price' => $product->product_total_price,
                'order_email' => $product->pos_email,
                'order_status' => $request->status,
            ]);
        }

        $del = Add_POS_Product::query()->delete();



        return response(['status' => 1, 'message' => 'success']) ??
            response(['status' => 2, 'message' => 'failed']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sql = POS_UserInfo::select('status')->find($id);
        if ($sql->status == 'Pending') {
            POS_UserInfo::where('id', '=', $id)->update([
                'status' => 'Completed'
            ]);
            return redirect()->back()->with('success', 'Status Changed to Completed');
        } else {
            POS_UserInfo::where('id', '=', $id)->update([
                'status' => 'Pending'
            ]);
            return redirect()->back()->with('success', 'Status Changed to Pending');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $invoice)
    {

        $products = Product::paginate(5, ['*'], 'products_page');
        $user = POS_UserInfo::where('invoice_number', $invoice)->first();
        $pos = POS_OrderInfo::where('order_invoice', $invoice)

            ->paginate(5, ['*'], 'pos_page');





        return view('dashboard.POS.updatePOSProduct', compact('products', 'pos', 'user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $invoice)
    {
        $invoice = $request->invoice;

        $sql = POS_UserInfo::where('invoice_number', $invoice)->update([
            'invoice_number' => $invoice,
            'user_name' => $request->user_name,
            'contact' => $request->contact,
            'total_cash' => $request->total_cash,
            'status' => $request->status,
        ]);
        $fetch = POS_OrderInfo::query()->get();
        if ($fetch->isEmpty()) {
            return response(['status' => 3, 'message' => 'No products found']);
        }

        foreach ($fetch as $product) {
            $order = POS_OrderInfo::where('order_invoice', $invoice)->update([
                'order_invoice' => $invoice,
                'order_by' => $request->user_name,
                'order_product_name' => $product->order_product_name,
                'order_code' => $product->order_code,
                'order_unit_price' => $product->order_unit_price,
                'order_quantity' => $product->order_quantity,
                'order_total_price' => $product->order_total_price,
                'order_email' => $product->order_email,
                'order_status' => $request->status,
            ]);
        }




        return response(['status' => 1, 'message' => 'success'])
            ??
            response(['status' => 2, 'message' => 'failed']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $pOS_UserInfo)
    {
        $del = POS_UserInfo::where('id', $pOS_UserInfo)->delete();
        
        return redirect()->back()->with('success', 'All Product deleted successfully') ??
            redirect()->back()->with('error', 'Something went wrong');
    }
}
