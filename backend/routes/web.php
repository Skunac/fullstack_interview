<?php

use App\Http\Controllers\IngredientsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(RecipesController::class)->group(function () {
    Route::get('/recipies', 'getAllRecipes');
    Route::get('/insertdata/', 'insertData');
    // Route::get('/getallrecipes','getAllRecipes')->middleware('cors');
    // Route::get('/getrecipesbypreptime/{prep_time}', 'getRecipesByPrepTime');
    // Route::get('/getrecipesbyservings/{servings}', 'getRecipesByServings');
    // Route::get('/getrecipesbytotalpreptime/{total_prep_time}', 'getRecipesByTotalPrepTime');
    // Route::get('/getrecipesbycalories/{calories}', 'getRecipesByCalories');
    // Route::get('/getrecipesbytitle/{title}', 'getRecipesByTitle');
});

Route::controller(IngredientsController::class)->group(function () {
    Route::get('/getallingredients', 'getAllIngredients');
    Route::get('/getingredientbyname/{name}', 'getIngredientByName');
});