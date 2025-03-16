<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCategoryController extends Controller
{
    public function index($catid){
        $sql=Product::with(['category','subcategory'])->where('category_id',$catid)->get();
        $sub=SubCategory::where('category_id',$catid)->get();
        return view('user_site.category',compact('sql','sub'));
    }
    



}
