<?php

namespace App\Http\Controllers;

use App\Validators\MealRequestValidator;
use App\Services\MealQueryBuilder;
use App\Services\MealRelatedItemsBuilder;
use App\Services\MealResponseBuilder;
use Illuminate\Http\Request;

class MealController extends Controller
{
    
public function index(Request $request)
{
    $validated = MealRequestValidator::validate($request);

    $paginator = MealQueryBuilder::build($validated)->appends($request->except('page'));
    
    $meals = MealRelatedItemsBuilder::build($paginator, $validated['lang'], $validated['with']);

    return view('index', [
        'meals' => $meals,
        'meta' => [
            'currentPage' => $meals->currentPage(),
            'totalItems' => $meals->total(),
            'itemsPerPage' => $meals->perPage(),
            'totalPages' => $meals->lastPage(),
        ],
        'request' => $request->all(),
    ]);
}

    
}
