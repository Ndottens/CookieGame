<?php

namespace App\Http\Services;

use App\Enums\IngredientName;
use App\Models\Ingredient;

class RecipeService
{

    /**
     * @var
     */
    private $butterScotch;


    /**
     * @var
     */
    private $cinnamon;

    /**
     * RecipeService constructor.
     */
    public function __construct()
    {
        $this->butterScotch = Ingredient::where('name', '=', IngredientName::BUTTERSCOTCH)->firstOrFail();
        $this->cinnamon = Ingredient::where('name', '=', IngredientName::CINNAMON)->firstOrFail();
    }

    /**
     * @param $input
     * @return float|int
     */
    public function calculateScore($input)
    {
       $capacityScore = $this->getCapacityScore($input) < 0 ? 0 : $this->getCapacityScore($input);
       $durabilityScore = $this->getDurabilityScore($input) < 0 ? 0 : $this->getDurabilityScore($input);
       $tasteScore = $this->getTasteScore($input) < 0 ? 0 : $this->getTasteScore($input);
       $textureScore = $this->getTextureScore($input) < 0 ? 0 : $this->getTextureScore($input);
       $caloriesScore = $this->getCaloriesScore($input) < 0 ? 0 : $this->getCaloriesScore($input);

       return $capacityScore * $durabilityScore * $tasteScore * $textureScore * $caloriesScore;
    }

    /**
     * @param $input
     * @return float|int
     */
    public function getCapacityScore($input)
    {
        return $input[IngredientName::BUTTERSCOTCH] * $this->butterScotch->capacity + $input[IngredientName::CINNAMON] * $this->cinnamon->capacity;
    }

    /**
     * @param $input
     * @return float|int
     */
    public function getDurabilityScore($input)
    {
        return $input[IngredientName::BUTTERSCOTCH] * $this->butterScotch->durability + $input[IngredientName::CINNAMON] * $this->cinnamon->durability;
    }

    /**
     * @param $input
     * @return float|int
     */
    public function getTasteScore($input)
    {
        return $input[IngredientName::BUTTERSCOTCH] * $this->butterScotch->taste + $input[IngredientName::CINNAMON] * $this->cinnamon->taste;
    }

    /**
     * @param $input
     * @return float|int
     */
    public function getTextureScore($input)
    {
        return $input[IngredientName::BUTTERSCOTCH] * $this->butterScotch->texture + $input[IngredientName::CINNAMON] * $this->cinnamon->texture;
    }

    /**
     * @param $input
     * @return float|int
     */
    public function getCaloriesScore($input)
    {
        return $input[IngredientName::BUTTERSCOTCH] * $this->butterScotch->calories + $input[IngredientName::CINNAMON] * $this->cinnamon->calories;
    }

}
