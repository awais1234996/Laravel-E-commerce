<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql = Supplier::paginate(10);
        return view('dashboard.supplier.view_supplier', compact('sql'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.supplier.add_supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddSupplierRequest $request)
    {

        $exist = Supplier::where('supplier_name', '=', $request->supplier_name)->first();
        if ($exist) {
            return response(['status' => 0, 'message' => 'Supplier already exist']);
        } else {

            $sql = Supplier::create([
                'supplier_name' => $request->supplier_name,
                'supplier_email' => $request->supplier_email,
                'supplier_cnic' => $request->supplier_cnic
            ]);
            if ($sql) {
                return response()->json(['status' => 1, 'message' => 'Supplier Added Successfully']);
            } else {
                return response()->json(['status' => 2, 'message' => 'Supplier Not Added']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $sql = Supplier::find($supplier->id);
        return view('dashboard.supplier.update_supplier', compact('sql'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddSupplierRequest $request, Supplier $supplier)
    {


            $sql = Supplier::whereRaw('id = ?', [$supplier->id])->update([
                'supplier_name' => $request->supplier_name,
                'supplier_email' => $request->supplier_email,
                'supplier_cnic' => $request->supplier_cnic
            ]);
            if ($sql) {
                return response()->json(['status' => 1, 'message' => 'Supplier Updated Successfully']);
            } else {
                return response()->json(['status' => 2, 'message' => 'Supplier Not Updated']);
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $sql = Supplier::whereRaw('id = ?', [$supplier->id])->delete();
        if ($sql) {
            return redirect()->back()->with('success', 'Supplier deleted successfully');
        } else {

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
