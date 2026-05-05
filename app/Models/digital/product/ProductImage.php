<?php

namespace App\Models\Digital\Product;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'digital_product_images';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
