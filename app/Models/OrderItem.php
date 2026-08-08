<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;

class OrderItem extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function physicalProduct()
    {
        return $this->belongsTo(PhysicalProduct::class, 'product_id');
    }

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class, 'product_id');
    }

    public function getProductAttribute()
    {
        return $this->product_type == 'physical'
            ? $this->physicalProduct
            : $this->digitalProduct;
    }
}
