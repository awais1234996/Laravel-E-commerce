<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role=Role::paginate(10);
        return view('dashboard.role.view_role',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.role.add_role');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Role::where('role_name', $request->role_name)->first()) {

            return response()->json(['status' => 0, 'message' => 'Role Already Exist']);
        } else {


            $sql = Role::create([
                'role_name' => $request->role_name,
                'role_access' => $request->role_access,
                'category' => $request->category,
                'subcategory' => $request->sub_category,
                'products' => $request->product,
                'supplier' => $request->supplier,
                'quantity' => $request->quantity,
                'user_management' => $request->user_management,
                'orders' => $request->orders,
                'pos' => $request->pos,
                'contact' => $request->contact,
            ]);
            if ($sql) {
                return response()->json(['status' => 1, 'message' => 'Role Created Successfully']);
            } else {
                return response()->json(['status' => 2, 'message' => 'Role Not Created']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $sql = Role::find($role->id);
        return view('dashboard.role.update_role', compact('sql'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {



            $sql = Role::find($role->id)->update([
                'role_name' => $request->role_name,
                'role_access' => $request->role_access,
                'category' => $request->category,
                'subcategory' =>$request->subcategory,
                'products' => $request->product,
                'supplier' => $request->supplier,
                'quantity' => $request->quantity,
                'user_management' => $request->user_management,
                'orders' => $request->orders,
                'pos' => $request->pos,
                'contact' => $request->contact,
            ]);
            if ($sql) {
                return response()->json(['status' => 1, 'message' => 'Role Updated Successfully']);
            } else {
                return response()->json(['status' => 2, 'message' => 'Role Not Updated']);
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $del=Role::find($role->id)->delete();
        if ($del) {
            return redirect()->back()->with('success', 'Role Deleted Successfully');
        }else{
            return redirect()->back()->with('error', 'Role Deleted Failed');
        }
    }
}
