<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use App\Models\Language;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $langCode = $request->input('lang', 'en');
        $language = Language::where('code', $langCode)->first();
        $languageId = $language ? $language->id : null;
        if (!$languageId)
            abort(404);

        $meals = Meal::with([
            'translations' => function ($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
            'category.translations' => function ($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
            'tags.translations' => function ($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
            'ingredients.translations' => function ($query) use ($languageId) {
                $query->where('language_id', $languageId);
            }
        ])->get();
        return view('index', ['meals' => $meals]);
    }
}
