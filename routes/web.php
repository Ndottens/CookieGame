<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/getScore', [RecipeController::class, 'getScore']);
