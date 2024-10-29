<?php

namespace App\Services;

class MealResponseBuilder
{
    public static function buildArray($paginator, $meals, $request)
    {
        return [
            'meta' => [
                'currentPage' => $paginator->currentPage(),
                'totalItems' => $paginator->total(),
                'itemsPerPage' => $paginator->perPage(),
                'totalPages' => $paginator->lastPage(),
            ],
            'data' => $meals,
            'request' => $request->all(),
        ];
    }
}