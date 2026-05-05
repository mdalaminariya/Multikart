<?php

namespace App\Models\physical\category;

use Illuminate\Database\Eloquent\Model;
use App\Models\physical\category\Category;
use App\Models\Physical\Product\Product;

class SubCategory extends Model
{
    protected $table = 'subcategories';

    protected $guarded = [];
    // belongs to category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // has many products
    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }
}
