<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub = Subcategory::with('category')->paginate(10);
        return view('dashboard.subcategory.view_subcategory', compact('sub'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cat = Category::get();
        return view('dashboard.subcategory.add_subcategory', compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddSubcategoryRequest $request)
    {
        $sql = Subcategory::create([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_description' => $request->description
        ]);
        if ($sql) {
            return response()->json(['status' => 1, 'message' => 'Subcategory Created Successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Subcategory Not Created', 'error']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        // $sql = Subcategory::with('category')->get();
        // return view('subcategory.create', compact('sql'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Fetch the specific subcategory and its associated category
        $subcategory = Subcategory::with('category')->findOrFail($id);

        // Fetch all categories for the dropdown
        $categories = Category::all();

        return view('dashboard.subcategory.update_subcategory', compact('subcategory', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(AddSubcategoryRequest $request, Subcategory $subcategory)
    {
        $sql = Subcategory::whereRaw('id=?', [$subcategory->id])->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_description' => $request->description
        ]);
        if ($sql) {
            return response(['status' => 1, 'message' => 'Subcategory Updated Successfully']);
        } else {
            return response(['status' => 2, 'message' => 'Subcategory Not Updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        $sql = Subcategory::whereRaw('id=?', [$subcategory->id])->delete();
        if ($sql) {
            return redirect()->route('subcategory.index')->with('success', 'Subcategory Deleted Successfully');
        } else {
            return redirect()->route('subcategory.index')->with('error', 'Subcategory Not Deleted');
        }
    }
}
