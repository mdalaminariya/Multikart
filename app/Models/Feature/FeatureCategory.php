<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class FeatureCategory extends Model
{
    protected $table = 'feature_categories';
    protected $guarded = [];

    public function features() {
     return $this->hasMany(Feature::class, 'feature_category_id');
     }
}
