<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guarded = [];
   protected $delete = ['created_at', 'updated_at'];
   


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
