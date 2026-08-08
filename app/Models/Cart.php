<?php

namespace App\Models;

use App\Models\Physical\Product\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_type',
        'price',
        'quantity',
    ];

    // Physical Product
    public function physicalProduct()
    {
        return $this->belongsTo(PhysicalProduct::class, 'product_id');
    }
        public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    // Digital Product
    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class, 'product_id');
    }
        public function image()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    // Common accessor
    public function getProductAttribute()
    {
        return $this->product_type == 'physical'
            ? $this->physicalProduct
            : $this->digitalProduct;
    }
}
