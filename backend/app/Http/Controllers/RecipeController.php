<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{
    // returns every rows of the recipes table
    public function getAllRecipes(){
        $recipes = Recipe::all();
        return response()->json(['Recipes' => $recipes]);
    }

    //checks if a request to add a row in the recipes table is valid, if it is it adds it
    public function addRecipe(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'ingredients' => 'required|string|max:1000',
            'instructions' => 'required|string|max:1000',
            'prep_time' => 'required|int',
            'cook_time' => 'required|int',
            'servings' => 'required|int',
            'calories' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->messages()], 422);
        } else {
            $recipe = Recipe::create([
                'title' => $request->title,
                'description' => $request->description,
                'ingredients' => $request->ingredients,
                'instructions' => $request->instructions,
                'prep_time' => $request->prep_time,
                'cook_time' => $request->cook_time,
                'total_time' => $request->prep_time + $request->cook_time,
                'servings' => $request->servings,
                'calories' => $request->calories
            ]);

            if($recipe){
                return response()->json([
                    'message' => 'Recipe Created Successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Error'
                ], 500);
            }
        }
    }

    //checks if a request to update a row in the recipes table is valid, if it is it updates it
    public function updateRecipe(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'ingredients' => 'required|string|max:1000',
            'instructions' => 'required|string|max:1000',
            'prep_time' => 'required|int',
            'cook_time' => 'required|int',
            'servings' => 'required|int',
            'calories' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->messages()], 422);
        } else {
            $recipe = Recipe::find($id);
            if($recipe){
                $recipe->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'ingredients' => $request->ingredients,
                    'instructions' => $request->instructions,
                    'prep_time' => $request->prep_time,
                    'cook_time' => $request->cook_time,
                    'total_time' => $request->prep_time + $request->cook_time,
                    'servings' => $request->servings,
                    'calories' => $request->calories
                ]);
                return response()->json([
                    'message' => 'Recipe Updated Successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Error'
                ], 404);
            }
        }
    }

    //checks if it's possible to delete the recipe, if it is it deletes its row from the recipes table
    public function deleteRecipe(Request $request, $id){
        $recipe = Recipe::find($id);
        if ($recipe) {
            Recipe::where('id',$id)->delete();
            return response()->json([
                'message' => 'Recipe deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 404);
        }
    }
}
