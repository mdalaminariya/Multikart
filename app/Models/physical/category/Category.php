<?php

namespace App\Models\physical\category;

use Illuminate\Database\Eloquent\Model;
use App\Models\physical\category\SubCategory;
class Category extends Model
{
     protected $guarded = [];

     public function subcategories(){
        return $this->hasMany(SubCategory::class, 'category_id');
     }
}
