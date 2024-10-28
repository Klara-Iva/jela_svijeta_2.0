<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\IngredientTranslation;
use App\Models\Language; // Dodajemo model za jezike
use Faker\Generator as Faker;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Faker::class);

        $languages = Language::all();

        for ($i = 0; $i < 10; $i++) {
            $ingredient = Ingredient::create(['slug' => $faker->slug]);

            foreach ($languages as $language) {
                IngredientTranslation::create([
                    'ingredient_id' => $ingredient->id,
                    'language_id' => $language->id,
                    'title' => $faker->word,
                ]);
            }
        }
    }
}