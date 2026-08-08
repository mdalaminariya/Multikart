<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Physical\product\Product as PhysicalProduct;
use App\Models\Digital\product\Product as DigitalProduct;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'users'; // IMPORTANT (because vendor = user)
    protected $guarded = [];

    // Physical Products
    public function physicalProducts()
    {
        return $this->hasMany(PhysicalProduct::class, 'user_id');
    }

    // Digital Products
    public function digitalProducts()
    {
        return $this->hasMany(DigitalProduct::class, 'user_id');
    }
}
