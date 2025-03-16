<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Mail\OrderMail;
use App\Models\CheckOut;
use App\Models\OnlineOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql = CheckOut::paginate(10);
        return view('dashboard.users.view_users', compact('sql'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_site.checkout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invoice = uniqid();

        $sql = CheckOut::create([
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_phone' => $request->phone,
            'user_country' => $request->country,
            'user_state' => $request->state,
            'user_city' => $request->city,
            'user_postal_code' => $request->postal_code,
            'user_address' => $request->address,
            'user_invoice' => $invoice,
            'user_status' => 'Pending',
        ]);

        if ($sql) {
            $email = Auth::guard('user')->user()->email;

            $osql = Cart::where('cart_email', $email)->get();

            $orderTotalprice = 0;

            foreach ($osql as $cartItem) {
                $orderName = $cartItem->product_name;
                $orderCode = $cartItem->product_code;
                $unitPrice = $cartItem->unit_price;
                $orderQuantity = $cartItem->product_quantity;
                $orderimage = $cartItem->product_image;

                $orderTotalprice += $cartItem->total_price;

                OnlineOrders::create([
                    'order_name' => $orderName,
                    'order_code' => $orderCode,
                    'order_price' => $unitPrice,
                    'order_quantity' => $orderQuantity,
                    'order_total_price' => $cartItem->total_price,
                    'order_image' => $orderimage,
                    'order_email' => $email,
                    'order_invoice' => $invoice,
                    'order_status' => 'Pending',
                ]);
            }

            Cart::where('cart_email', $email)->delete();
        }

        $sub = "Order Placed";
        $msg = "<h1>Order Details:</h1>";
        $msg .= "<h2>Invoice: </h2>" . $invoice;

        foreach ($osql as $cartItem) {
            $orderName = $cartItem->product_name;
            $orderCode = $cartItem->product_code;
            $orderQuantity = $cartItem->product_quantity;

            $msg .= "<h2>Order Name: </h2>" . $orderName;
            $msg .= "<h2>Order Code: </h2>" . $orderCode;
            $msg .= "<h2>Order Quantity: </h2>" . $orderQuantity;
        }

        $msg .= "<h2>Total Order Price: </h2>" . $orderTotalprice;

        $mail = Mail::to($email)->send(new OrderMail($msg, $sub));

        if ($mail) {
            return redirect()->back()->with('success', 'Order Placed Successfully');
        } else {
            return redirect()->back()->with('error', 'Order Placed Failed');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(CheckOut $CheckOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CheckOut $CheckOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckOut $CheckOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckOut $CheckOut)
    {
        //
    }
}
