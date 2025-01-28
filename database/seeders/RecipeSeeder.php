<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Ingredient;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $recipes = [
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2017/08/14/20/17/aloe-vera-2648089_960_720.jpg',
                'name' => 'Tomato Soup',
                'information' => 'A warm and comforting soup made from tomatoes and spices.',
                'ingredients' => ['Tomato', 'Salt', 'Pepper'],
            ],
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2020/06/16/15/05/snake-plant-5306710_960_720.jpg',
                'name' => 'Chicken Stew',
                'information' => 'A hearty stew with chicken and vegetables.',
                'ingredients' => ['Chicken', 'Carrot', 'Potato', 'Salt'],
            ],
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2020/08/30/10/14/fiddle-leaf-fig-5530112_960_720.jpg',
                'name' => 'Beef Stir-fry',
                'information' => 'A quick and delicious stir-fry with beef and fresh vegetables.',
                'ingredients' => ['Beef', 'Union', 'Pepper'],
            ],
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2016/03/28/09/34/spider-plant-1282332_960_720.jpg',
                'name' => 'Carrot Salad',
                'information' => 'A fresh salad made with carrots, eggs, and seasoning.',
                'ingredients' => ['Carrot', 'Egg', 'Salt', 'Pepper'],
            ],
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2017/08/07/00/37/basil-2597125_960_720.jpg',
                'name' => 'Egg Omelette',
                'information' => 'A classic egg omelette with a touch of seasoning.',
                'ingredients' => ['Egg', 'Union', 'Salt', 'Pepper'],
            ],
        ];

        foreach ($recipes as $recipeData) {
            $recipe = Recipe::create([
                'image_url' => $recipeData['image_url'],
                'name' => $recipeData['name'],
                'information' => $recipeData['information'],
            ]);

            $ingredientIds = Ingredient::whereIn('ingredient', $recipeData['ingredients'])->pluck('id');
            $recipe->ingredients()->sync($ingredientIds);
        }
    }
}
