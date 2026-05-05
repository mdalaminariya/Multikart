<?php

namespace App\Models\Digital\Category;

use Illuminate\Database\Eloquent\Model;
use App\Models\Digital\Category\SubCategory;

class Category extends Model
{
    protected $guarded = [];

    protected $table = 'digital_categories';

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
