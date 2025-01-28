<?php

use App\Http\Controllers\API\RecipeController;
use App\Http\Controllers\API\IngredientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Hier kun je alle API-routes voor je applicatie registreren. Deze routes
| worden geladen door de RouteServiceProvider binnen een groep die
| is toegewezen aan het "api" middleware-group.
|
*/

// API Resource Routes voor Planten en Categorieën zonder middleware
Route::apiResource('recipes', RecipeController::class);
Route::apiResource('ingredients', IngredientController::class);

