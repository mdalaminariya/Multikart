<?php

namespace App\Models\Digital\Category;

use Illuminate\Database\Eloquent\Model;
use App\Models\Digital\Category\Category;
use App\Models\Digital\Product\Product;

class SubCategory extends Model
{
    protected $table = 'digital_subcategories';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }
}
