<?php

namespace App\Services;

use App\Models\Language;

class MealRelatedItemsBuilder
{
    public static function build($paginator, $lang, $with)
    {
        $languages = Language::all()->pluck('id', 'code')->toArray();
        $langId = $languages[$lang] ?? null;

        $paginator->getCollection()->transform(
            function ($meal) use ($langId, $with) {
                $translation = $meal->translations->where('language_id', $langId)->first();

                $result = [
                    'id' => $meal->id,
                    'title' => $translation->title ?? 'N/A',
                    'description' => $translation->description ?? 'N/A',
                    'status' => $meal->status,
                ];

                if (in_array('category', $with) && $meal->category) {
                    $categoryTranslation = $meal->category->translations->where('language_id', $langId)->first();
                    $result['category'] = [
                        'id' => $meal->category->id,
                        'title' => $categoryTranslation->title ?? 'N/A',
                        'slug' => $meal->category->slug,
                    ];
                }

                if (in_array('tags', $with)) {
                    $result['tags'] = $meal->tags->map(
                        function ($tag) use ($langId) {
                            $tagTranslation = $tag->translations->where('language_id', $langId)->first();
                            return [
                                'id' => $tag->id,
                                'title' => $tagTranslation->title ?? 'N/A',
                                'slug' => $tag->slug,
                            ];
                        }
                    );
                }

                if (in_array('ingredients', $with)) {
                    $result['ingredients'] = $meal->ingredients->map(
                        function ($ingredient) use ($langId) {
                            $ingredientTranslation = $ingredient->translations->where('language_id', $langId)->first();
                            return [
                                'id' => $ingredient->id,
                                'title' => $ingredientTranslation->title ?? 'N/A',
                                'slug' => $ingredient->slug,
                            ];
                        }
                    );
                }

                return $result;
            }
        );

        return $paginator;
    }

}