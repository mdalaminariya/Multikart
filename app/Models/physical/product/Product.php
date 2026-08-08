<?php

namespace App\Models\Physical\Product;

use App\Models\physical\category\SubCategory;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use App\Models\Physical\Product\ProductImage;

class Product extends Model
{
    protected $guarded = [];
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
