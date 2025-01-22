<?php

namespace App\Models;

use App\Models\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Style extends Model
{
    protected $fillable = [
        'name',
    ];

    public function food(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'food_style');
    }
}
