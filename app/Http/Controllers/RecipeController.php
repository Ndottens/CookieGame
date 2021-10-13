<?php

namespace App\Http\Controllers;

use App\Enums\IngredientName;
use App\Enums\JsonMessages;
use App\Http\Requests\RecipeRequest;
use App\Http\Services\RecipeService;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;

class RecipeController extends Controller
{
    /**
     * @var RecipeService
     */
    private $recipeService;

    private $maxScore = 32760000000;

    /**
     * RecipeController constructor.
     * @param RecipeService $recipeService
     */
    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    /**
     * @return JsonResponse
     */
    public function getIngredients(): JsonResponse
    {
        return response()->json(Ingredient::all());
    }

    /**
     * @return JsonResponse
     */
    public function getLeaderboard(): JsonResponse
    {
        $recipes = Recipe::orderBy('score', 'desc')->get()->map(function($recipe) {
            $recipe->percentScore = $recipe->score / $this->maxScore * 100;
            return $recipe;
        });
        return response()->json($recipes);
    }

    /**
     * @param RecipeRequest $request
     * @return JsonResponse
     */
    public function getScore(RecipeRequest $request): JsonResponse
    {
        if($request[IngredientName::BUTTERSCOTCH] + $request[IngredientName::CINNAMON] > 100 || $request[IngredientName::BUTTERSCOTCH] + $request[IngredientName::CINNAMON] < 100) {
            return response()->json(JsonMessages::FAILED, 401);
        }

        $recipe = Recipe::create([
            IngredientName::BUTTERSCOTCH => $request[IngredientName::BUTTERSCOTCH],
            IngredientName::CINNAMON => $request[IngredientName::CINNAMON],
            'score' => $this->recipeService->calculateScore($request)
        ]);

        return response()->json(['message' => JsonMessages::SUCCESS, 'recipe' => $recipe]);
    }
}
