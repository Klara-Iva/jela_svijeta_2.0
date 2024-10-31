<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Validators\MealRequestValidator;
use App\Services\MealQueryBuilder;
use App\Services\MealRelatedItemsBuilder;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Ingredient;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $validated = MealRequestValidator::validate($request);
        $query = MealQueryBuilder::build($validated);

        $paginator = $query->appends($request->except('page'));
        $meals = MealRelatedItemsBuilder::build($paginator, $validated['lang'], $validated['with']);

        $languages = Language::all()->pluck('id', 'code')->toArray();
        $langId = $languages[$validated['lang']] ?? null;

        $categories = Category::whereHas('translations', function ($query) use ($langId) {
            $query->where('language_id', $langId);
        })
            ->with([
                'translations' => function ($query) use ($langId) {
                    $query->where('language_id', $langId);
                }
            ])->get();

        $tags = Tag::whereHas('translations', function ($query) use ($langId) {
            $query->where('language_id', $langId);
        })
            ->with([
                'translations' => function ($query) use ($langId) {
                    $query->where('language_id', $langId);
                }
            ])->get();

        $ingredients = Ingredient::whereHas('translations', function ($query) use ($langId) {
            $query->where('language_id', $langId);
        })
            ->with([
                'translations' => function ($query) use ($langId) {
                    $query->where('language_id', $langId);
                }
            ])->get();

        return view('index', [
            'meals' => $meals,
            'meta' => [
                'currentPage' => $meals->currentPage(),
                'totalItems' => $meals->total(),
                'itemsPerPage' => $meals->perPage(),
                'totalPages' => $meals->lastPage(),
            ],
            'categories' => $categories,
            'tags' => $tags,
            'ingredients' => $ingredients,
            'request' => $request->all(),
        ]);
    }

}