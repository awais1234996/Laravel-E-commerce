<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql = Category::paginate(5);
        return view('dashboard.category.view_category', compact('sql'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCategoryRequest $request)
    {
        $exist = Category::where('category_name', '=', $request->category_name)->first();
        if ($exist) {
            return response(['status' => 0, 'message' => 'Category already exist']);
        } else {


            $sql = Category::create([
                'category_name' => $request->category_name,
                'description' => $request->description
            ]);


            return response(['status' => 1, 'message' => 'Category added successfully']) ?? response(['status' => 2, 'message' => 'Something went wrong']);;
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $sql = Category::find($category->id);
        return view('dashboard.category.update_category', compact('sql'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddCategoryRequest $request, Category $category)
    {

        $sql = Category::whereRaw('id = ?', [$category->id])->update([
            'category_name' => $request->category_name,
            'description' => $request->description
        ]);

        return response(['status' => 1, 'message' => 'Category updated successfully']) ?? response(['status' => 2, 'message' => 'Something went wrong']);;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::whereRaw('id = ?', [$category->id])->delete();

        return redirect()->back()->with('success', 'Category deleted successfully') ?? redirect()->back()->with('error', 'Something went wrong');
    }
}
