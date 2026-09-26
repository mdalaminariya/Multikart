<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'features';
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(FeatureCategory::class, 'feature_category_id');
    }
}
