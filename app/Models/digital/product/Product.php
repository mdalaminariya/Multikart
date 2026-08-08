<?php

namespace App\Models\Digital\Product;

use App\Models\Digital\Category\SubCategory;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use App\Models\Digital\Product\ProductImage;

class Product extends Model
{
    protected $guarded = [];

    protected $table = 'digital_products';
    protected $casts = [
    'colors' => 'string', // Or 'array' if you're storing colors as a JSON string
    'sizes' => 'string',  // Same for sizes
];
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function subcategory()
{
    return $this->belongsTo(SubCategory::class, 'subcategory_id');
}
public function reviews()
{
    return $this->hasMany(Review::class);
}

}
