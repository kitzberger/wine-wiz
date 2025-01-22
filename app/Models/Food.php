<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Food extends Model
{
    protected $fillable = [
        'name',
        'price',
        'type',
    ];

    public function styles(): BelongsToMany
    {
        return $this->belongsToMany(Style::class, 'food_style');
    }
}
