<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\MealTranslation;
use App\Models\Language;
use App\Models\Category;
use Faker\Generator as Faker;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Faker::class);
        $languages = Language::all();
        $categories = Category::all();
        for ($i = 0; $i < 10; $i++) {
            $meal = Meal::create([
                'slug' => $faker->slug,
                'category_id' => random_int(1, 10) <= 7 ? $categories->random()->id : null,
            ]);

            foreach ($languages as $language) {
                MealTranslation::create([
                    'meal_id' => $meal->id,
                    'language_id' => $language->id,
                    'title' => $faker->word,
                    'description' => $faker->sentence,
                ]);
            }
        }
    }
}
