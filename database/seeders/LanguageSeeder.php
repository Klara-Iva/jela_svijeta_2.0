<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $languages = [
            ['code' => 'hr', 'name' => 'Hrvatski'],
            ['code' => 'en', 'name' => 'English'],
            ['code' => 'de', 'name' => 'Deutsch'],
        ];

        foreach ($languages as $lang) {
            Language::create([
                'code' => $lang['code'],
                'name' => $lang['name'],
            ]);
        }
    }
}