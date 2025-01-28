<?php
namespace App\Http\Resources\Ingredients;

use App\Http\Resources\Recipes\RecipeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'     => $this->id,
            'ingredient'   => $this->ingredient,
            'recipe' => RecipeResource::collection($this->whenLoaded('recipe')),
        ];
    }
}
