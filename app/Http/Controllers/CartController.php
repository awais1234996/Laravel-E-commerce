<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $cart = Cart::where('id', 5)->get();

        // return view('user_site.shoppingCart', compact('cart'));

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
        if (Auth::guard('user')->user()) {
            if (Cart::where('product_name', $request->product_name)->where('cart_email', $request->email)->exists()) {
                return redirect()->back()->with('error', 'Product already added to cart');
            } else {



                $sql = Cart::create([

                    'product_name' => $request->product_name,
                    'product_code' => $request->product_code,
                    'unit_price' => $request->unit_price,
                    'product_quantity' => 1,
                    'total_price' => $request->unit_price,
                    'product_image' => $request->picture,
                    'cart_email' => $request->email
                ]);
                if ($sql) {
                    return response()->json(['success' => true]);
                }
            }
        } else {
            return view('user_site.login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($email)
    {
        $deleted = Cart::where('cart_email', $email)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'All cart items deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart) {}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        Cart::find($cart->id)->delete();
        return redirect()->back()->with('success', 'Cart deleted successfully') ?? redirect()->back()->with('error', 'Something went wrong');
    }
}
