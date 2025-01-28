<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            'Tomato',
            'Carrot',
            'Patato',
            'Egg',
            'Union',
            'Salt',
            'Pepper',
            'Chicken',
            'Beef',
            'Sugar',
        ];
        foreach ($ingredients as $ingredient) {
            Ingredient::updateOrCreate(
                ['ingredient' => $ingredient]
            );
        }
    }
}
