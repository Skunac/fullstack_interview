<?php

use App\Http\Controllers\IngredientsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Middleware\checkAddRequestFull; 

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
    Route::post('/recipies', 'addRecipe')->Middleware([checkAddRequestFull::class]);
    Route::put('/recipe/{id}', 'updateRecipe');
    Route::delete('/recipe/{id}', 'deleteRecipe');
});