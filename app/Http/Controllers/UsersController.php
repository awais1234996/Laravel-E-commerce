<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=CheckOut::paginate(10);
        return view('dashboard.users.view_users',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.addusers');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sql = CheckOut::select('user_status')->find($id);
        if ($sql->user_status == 'Pending') {
            CheckOut::where('id', '=', $id)->update([
                'user_status' => 'Completed'
            ]);
            return redirect()->back()->with('success', 'Status Changed to Completed');
        } else {
            CheckOut::where('id', '=', $id)->update([
                'user_status' => 'Pending'
            ]);
            return redirect()->back()->with('success', 'Status Changed to Pending');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sql=CheckOut::find($id)->delete();
        return redirect()->back()->with('success','Deleted');
    }
}
