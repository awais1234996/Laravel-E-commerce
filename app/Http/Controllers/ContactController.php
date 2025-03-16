<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql=Contact::paginate(10);
        return view('dashboard.contact.view_contact',compact('sql'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_site.contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sql=Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message

        ]);
        if($sql){
            return redirect()->back()->with('success','Message sent successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $sql=Contact::find($id);
        $sql->delete();
        if($sql){
            return redirect()->back()->with('success','Message deleted successfully');
        }else{
            return redirect()->back()->with('error','Message not deleted');
        }
    }
}
