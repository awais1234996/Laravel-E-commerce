<?php

namespace App\Http\Controllers;

use App\Models\Quantity;
use Illuminate\Http\Request;
use App\Http\Requests\AddQuantityRequest;

class QuantityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql=Quantity::paginate();
        return view('dashboard.quantity.view_quantity',compact('sql'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.quantity.add_quantity');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddQuantityRequest $request)
    {
        $sql = Quantity::create([
            'quantity' => $request->quantity,
            'quantity_type' => $request->quantity_type,
        ]);
        if ($sql) {
            return response()->json(['status' => 1, 'message' => 'quantity Added Successfully']);
        } else {
            return response()->json(['status' => 2, 'message' => 'quantity Not Added']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quantity $quantity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quantity $quantity)
    {
        $sql=Quantity::find($quantity->id);
        return view('dashboard.quantity.update_quantity',compact('sql'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quantity $quantity)
    {
        $sql=Quantity::whereRaw('id=?',[$quantity->id])->update([
            'quantity'=>$request->quantity,
            'quantity_type'=>$request->quantity_type
        ]);
        if($sql){
            return response()->json(['status'=>1,'message'=>'Quantity Updated Successfully']);
        }else{
            return response()->json(['status'=>2,'message'=>'Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quantity $quantity)
    {
        $sql=Quantity::whereRaw('id=?',[$quantity->id])->delete();
        if($sql){
        return redirect()->route('quantity.index')->with('success','Quantity Deleted Successfully');
        }else{
            return redirect()->route('quantity.index')->with('error','Something went wrong');
        }
    }
}
