<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(RecipeController::class)->group(function () {
    Route::get('/recipies', 'getAllRecipes');
    Route::post('/recipies', 'addRecipe');
    Route::put('/recipe/{id}', 'updateRecipe');
    Route::delete('/recipe/{id}', 'deleteRecipe');
});