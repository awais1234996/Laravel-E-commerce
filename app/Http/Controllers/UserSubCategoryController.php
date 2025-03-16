<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class UserSubCategoryController extends Controller
{
    public function index($subcatid){
        $subcat=Product::with(['category','subcategory'])->where('subcategory_id',$subcatid)->get();
        return view('user_site.subcategory',compact('subcat'));
    }
    public function product($subcatid){
        $product=Product::with(['category','subcategory'])->where('subcategory_id',$subcatid)->get();
        return view('user_site.product',compact('product'));
    }
    // public function sub($subcatid){
    //     $sql=Product::with(['category','subcategory'])->where('subcategory_id',$subcatid)->get();
    //     return view('user_site.subcategory',compact('sql'));
    // }
    public function Subcategory($catid){
        $subnames=Subcategory::where('category_id',$catid)->get();

        return view('user_site.subcategory',compact('subnames'));
    }
    // public function subindex($catid){
    //     $sql=Product::with(['category','subcategory'])->where('subcategory_id',$catid)->get();
    //     // $sub=SubCategory::where('category_id',$catid)->get();
    //     return view('user_site.subcategory',compact('sql'));
    // }


    public function subindex($catid){
        $sql=Product::with(['category','subcategory'])->where('category_id',$catid)->get();
        $sub=SubCategory::where('category_id',$catid)->get();
        return view('user_site.subcategory',compact('sql','sub'));
    }
}
