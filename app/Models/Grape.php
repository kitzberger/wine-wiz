<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Grape extends Model
{
    protected $fillable = [
        'name',
    ];

    public function wines(): BelongsToMany
    {
        return $this->belongsToMany(Wine::class, 'wine_grape')
            ->withPivot('percentage');
    }
}
