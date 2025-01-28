<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient',
    ];

    /**
     * Get all plants associated with the category.
     */
    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'ingredient_recipe');
    }
}
