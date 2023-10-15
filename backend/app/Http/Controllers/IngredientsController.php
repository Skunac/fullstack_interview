<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class IngredientsController extends Controller
{
    public function getAllIngredients(){
        $ingredients = Ingredients::all();
        return view('recipes.index', compact('ingredients'));
    }

    public function getIngredientByName($name){
        $ingredient = Ingredients::where('name',$name)->get();
        return response()->json(['Ingredient' => $ingredient]);
    }
}
