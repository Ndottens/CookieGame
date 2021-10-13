<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {
    Route::post('/score', [RecipeController::class, 'getScore']);
    Route::get('/ingredients', [RecipeController::class, 'getIngredients']);
    Route::get('/leaderboard', [RecipeController::class, 'getLeaderboard']);
});
