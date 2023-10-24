<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class RecipesController extends Controller
{
    public function getAllRecipes(){
        $recipes = Recipes::all();
        return response()->json(['Recipes' => $recipes]);
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

    public function updateRecipe(Request $request, $id){
        $recipe = Recipes::where('id',$id)->first();
        if($recipe){
            if($request->input('title')){
                $recipe->update(['title'=> $request->input('title')]);
            }
            if($request->input('description')){
                $recipe->update(['description'=> $request->input('description')]);
            }
            if($request->input('instructions')){
                $recipe->update(['instructions'=> $request->input('instructions')]);
            }
            if($request->input('ingredients')){
                $recipe->update(['ingredients'=> $request->input('ingredients')]);
            }
            if($request->input('prep_time')){
                $recipe->update(['prep_time'=> $request->input('prep_time')]);
            }
            if($request->input('cook_time')){
                $recipe->update(['cook_time'=> $request->input('cook_time')]);
            }
            if($request->input('servings')){
                $recipe->update(['servings'=> $request->input('servings')]);
            }
            if($request->input('calories')){
                $recipe->update(['calories'=> $request->input('calories')]);
            }

            $total_time = $recipe->prep_time + $recipe->cook_time;
            $recipe->update(['total_time'=> $total_time]);

            return response()->json(['message' => 'recipe updated'], 200);
        }
        else {
            return response()->json(['message' => 'Recipe non existent'], 400);
        }
    }

    public function addRecipe(Request $request){
        $recipe = new Recipes;
        $recipe->title = $request->input('title');
        $recipe->description = $request->input('description'); 
        $recipe->ingredients = $request->input('ingredients');
        $recipe->instructions = $request->input('instructions');
        $recipe->prep_time = (int)$request->input('prep_time');
        $recipe->cook_time = (int)$request->input('cook_time');
        $recipe->total_time = (int)$request->input('prep_time') + (int)$request->input('cook_time');
        $recipe->servings = (int)$request->input('servings');
        $recipe->calories = (int)$request->input('calories');
        $recipe->save();
        return response()->json(['message'=> 'Recipe added'], 200);
    }

    public function deleteRecipe(Request $request, $id){
        Recipes::where('id',$id)->delete();
        return response()->json(['message'=>'Recipe deleted'],204);
    }
}
