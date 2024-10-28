<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\TagTranslation;
use App\Models\Language; // Dodajemo model za jezike
use Faker\Generator as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Faker::class);

        $languages = Language::all();

        for ($i = 0; $i < 10; $i++) {
            $tag = Tag::create(['slug' => $faker->slug]);

            foreach ($languages as $language) {
                TagTranslation::create([
                    'tag_id' => $tag->id,
                    'language_id' => $language->id,
                    'title' => $faker->word,
                ]);
            }
        }
    }
}