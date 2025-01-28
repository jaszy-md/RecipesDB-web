<?php

namespace App\Http\Resources\Recipes;

use App\Http\Resources\Ingredients\IngredientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
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
            'id'           => $this->id,
            'image_url'    => $this->image_url,
            'name'         => $this->name,
            'information'  => $this->information,
            'ingredient'   => IngredientResource::collection($this->whenLoaded('ingredients')),
        ];
    }
}
