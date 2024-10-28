<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Ingredient;
use App\Models\Tag;

class MealIngredientTagSeeder extends Seeder
{
    public function run()
    {
        $meals = Meal::all();
        $ingredients = Ingredient::all();
        $tags = Tag::all();

        foreach ($meals as $meal) {
            $randomIngredientCount = rand(1, 4);
            $randomTagCount = rand(1, 4);
            
            $randomIngredients = $ingredients->random($randomIngredientCount);
            $randomTags = $tags->random($randomTagCount);

            $meal->ingredients()->attach($randomIngredients->pluck('id'));
            $meal->tags()->attach($randomTags->pluck('id'));
        }
    }
}