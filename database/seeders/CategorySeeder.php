<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language; // Dodajemo model za jezike
use Faker\Generator as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Faker::class);


        $languages = Language::all();

        for ($i = 0; $i < 10; $i++) {
            $category = Category::create(['slug' => $faker->slug]);

            foreach ($languages as $language) {
                CategoryTranslation::create([
                    'category_id' => $category->id,
                    'language_id' => $language->id,
                    'title' => $faker->word,
                ]);
            }
        }
    }
}