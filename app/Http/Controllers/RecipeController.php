<?php

namespace App\Http\Controllers;

use App\Enums\IngredientName;
use App\Http\Services\RecipeService;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;

class RecipeController extends Controller
{
    /**
     * @var RecipeService
     */
    private $recipeService;

    /**
     * RecipeController constructor.
     * @param RecipeService $recipeService
     */
    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }


    public function getScore(): JsonResponse
    {
        //#TODO get input from client

        $input = [
            IngredientName::BUTTERSCOTCH => 43,
            IngredientName::CINNAMON => 57,
        ];

        if($input[IngredientName::BUTTERSCOTCH] + $input[IngredientName::CINNAMON] > 100 || $input[IngredientName::BUTTERSCOTCH] + $input[IngredientName::CINNAMON] < 100) {
            return response()->json(['message' => 'Input has to be exact 100']);
        }

        $recipe = Recipe::create([
            IngredientName::BUTTERSCOTCH => $input[IngredientName::BUTTERSCOTCH],
            IngredientName::CINNAMON => $input[IngredientName::CINNAMON],
            'score' => $this->recipeService->calculateScore($input)
        ]);

        return response()->json($recipe);
    }
}
