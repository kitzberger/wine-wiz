<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Winemaker extends Model
{
    protected $fillable = [
        'name',
        'country_id',
    ];

    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    public function countries(): HasMany
    {
        return $this->belongsToMany(Country::class);
    }
}
