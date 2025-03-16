<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\AssignRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AssignRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assign = User::with('role')->paginate();
        return view('dashboard.role.view_assignUser', compact('assign'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.role.assign_user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sql = AssignRole::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role
        ]);
        if ($sql) {
            return redirect()->back();
        } else {
            return response(['status' => 2, 'message' => 'User Created Failed']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignRole $assignRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignRole $assignRole)
    {
        $sql = User::with('role')->find($assignRole->id);
        return view('dashboard.role.update_assignUser', compact('sql'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $assignRole)
    {
        $sql = User::whereRaw('id = ' . $assignRole)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role
        ]);
        if ($sql) {
            return redirect()->route('assignRole.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignRole $assignRole)
    {
        $del = User::find($assignRole->id)->delete();
        if ($del) {
            return redirect()->back()->with('success', 'User Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'User Deleted Failed');
        }
    }
}
