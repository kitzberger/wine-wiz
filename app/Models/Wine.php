<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wine extends Model
{
    protected $fillable = [
        'name',
        'name',
        'selling_price',
        'purchase_price',
        'vintage',
        'plu',
        'bottle_size',
        'alcohol',
        'acidity',
        'sugar',
        'quality',
        'tannin',
        'info',
        'maturation',

        'winemaker_id',
        'category_id',
        'city_id',
        'region_id',
        'country_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // public function grapes(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function winemaker(): BelongsTo
    {
        return $this->belongsTo(Winemaker::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
