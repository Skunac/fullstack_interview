<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class RecipesController extends Controller
{
    public function getAllRecipes(){
        $recipes = Recipes::all();
        return view('recipes.index', compact('recipes'));
    }

    public function getRecipesByPrepTime($prep_time){
        $recipes_prep_time = Recipes::where('prep_time',$prep_time)->get();
        return response()->json(['Recipes' => $recipes_prep_time]);
    }

    public function getRecipesByTotalPrepTime($total_prep_time){
        $recipes_total_prep_time = Recipes::where('total_time', $total_prep_time)->get();
        return response()->json(['Recipes' => $recipes_total_prep_time]);
    }

    public function getRecipesByServings($servings){
        $recipes_servings = Recipes::where('servings', $servings)->get();
        return response()->json(['Recipes' => $recipes_servings]);
    }

    public function getRecipesByCalories($calories){
        $recipes_calories = Recipes::where('calories','<=',$calories)->get();
        return response()->json(['Recipes' => $recipes_calories]);
    }

    public function getRecipesByTitle($title){
        $recipes_title = Recipes::where('title',$title)->get();
        return response()->json(['Recipes'=> $recipes_title]);
    }
}
