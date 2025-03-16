<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function Contactshow(string $id)
    {
        $sql = Contact::whereRaw('`id`=?', [$id])->first();
        return view('dashboard.contact.reply', compact('sql'));
    }
    public function Contactemail(request $request)
    {
        $email = $request->replyemail;
        $msg = $request->message;
        $sub = $request->subject;
        $sql = Mail::to($email)->send(new ContactMail($msg, $sub));
        if ($sql) {
            Contact::whereRaw('`email`=?', [$request->replyemail])->update([
                'status' => "Replied",
            ]);
            return redirect()->route('contact.index')->with('success', 'Email sent successfully');
        } else {
            return redirect()->back();
        }
    }
    public function orderemail(request $request)
    {
        $email = "awaisraza0303504@gmail.com";
        $msg = $request->message;
        $sub = $request->subject;
        $sql = Mail::to($email)->send(new ContactMail($msg, $sub));
        if ($sql) {

            return redirect()->back();
        }
    }


    public function destroy($email)
    {
        $deleted = Cart::where('cart_email', $email)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'All cart items deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }



    public function update(Request $request)
    {
        $cartItem = Cart::findOrFail($request->id);
        $cartItem->product_quantity = $request->quantity;
        $cartItem->total_price = $cartItem->product_quantity * $cartItem->unit_price;
        $cartItem->save();
        $cartTotal = Cart::sum('total_price');

        return response()->json([
            'success' => true,
            'cart_total' => $cartTotal,
            'item_total' => $cartItem->total_price
        ]);
    }
}
