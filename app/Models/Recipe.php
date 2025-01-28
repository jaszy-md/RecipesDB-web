<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'name',
        'information',
    ];

    /**
     * Get all ingredients associated with the plant.
     */
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_recipe');
    }
}
