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

            $total_time = $recipe->get('prep_time') + $recipe->get('cook_time');
            $recipe->update(['total_time'=> $total_time]);

            return response()->json(['message' => 'recipe updated'], 200);
        }
        else {
            return response()->json(['message' => 'Bad request'], 400);
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
        // Recipes::create([
        //     'title' => $request->input('title'),
        //     'description' => $request->input('description'),
        //     'instructions' => $request->input('instructions'),
        //     'ingredients' => $request->input('ingredients'),
        //     'prep_time' => (int)$request->input('prep_time'),
        //     'cook_time' => (int)$request->input('cook_time'),
        //     'total_time' => (int)$request->input('prep_time') + (int)$request->input('cook_time'),
        //     'servings' => (int)$request->input('servings'),
        //     'calories' => (int)$request->input('calories'),
        // ]);
        return response()->json(['message'=> 'Recipe added'], 200);
    }

    public function deleteRecipe(Request $request, $id){
        Recipes::where('id',$id)->delete();
        return response()->json(['message'=>'Recipe deleted'],204);
    }

    public function insertData(){
        $recipesData = [
            [
                'title' => 'Lasagnes au four',
                'description' => 'Des lasagnes maison avec de la viande, de la sauce tomate et du fromage.',
                'ingredients' => "pates,viande,sauce tomate,fromage", // Exemple d'ID d'ingrédients
                'instructions' => 'Préchauffez le four à 180°C. Préparez les lasagnes en superposant les couches de pâtes, de sauce et de fromage. Enfournez pendant 30 minutes.',
                'prep_time' => 30,
                'cook_time' => 30,
                'servings' => 6,
                'calories' => 450,
            ],
            [
                'title' => 'Salade César',
                'description' => 'Une salade fraîche avec de la laitue, du poulet, des croûtons et de la sauce César.',
                'ingredients' => "laitue,poulet,croutons,sauce César", // Exemple d'ID d'ingrédients
                'instructions' => 'Lavez la laitue et ajoutez-y du poulet grillé, des croûtons et de la sauce César. Mélangez et servez.',
                'prep_time' => 20,
                'cook_time' => 10,
                'servings' => 4,
                'calories' => 350,
            ],
            [
                'title' => 'Risotto aux champignons',
                'description' => 'Un risotto crémeux avec des champignons et du parmesan.',
                'ingredients' => "riz,champigno,parmesan", // Exemple d'ID d'ingrédients
                'instructions' => 'Faites revenir les champignons avec de l\'oignon dans du beurre. Ajoutez le riz et le bouillon en remuant. Une fois cuit, incorporez le parmesan.',
                'prep_time' => 15,
                'cook_time' => 30,
                'servings' => 4,
                'calories' => 400,
            ],
            [
                'title' => 'Poulet au curry',
                'description' => 'Des morceaux de poulet mijotés dans une sauce au curry crémeuse.',
                'ingredients' => "poulet,curry,creme", // Exemple d'ID d'ingrédients
                'instructions' => 'Faites revenir le poulet avec de l\'oignon. Ajoutez la sauce au curry et la crème. Laissez mijoter jusqu\'à ce que le poulet soit cuit.',
                'prep_time' => 20,
                'cook_time' => 40,
                'servings' => 4,
                'calories' => 380,
            ],
            [
                'title' => 'Pizza Margherita',
                'description' => 'Une pizza classique avec de la sauce tomate, de la mozzarella et du basilic.',
                'ingredients' => "pate a pizza,tomate, sauce tomate, mozzarella, basilic", // Exemple d'ID d'ingrédients
                'instructions' => 'Étalez la pâte à pizza, ajoutez la sauce, la mozzarella et le basilic. Enfournez pendant 15 minutes à 220°C.',
                'prep_time' => 10,
                'cook_time' => 15,
                'servings' => 3,
                'calories' => 300,
            ],
            [
                'title' => 'Pâtes à la bolognaise',
                'description' => 'Des pâtes avec une sauce à la viande et à la tomate.',
                'ingredients' => "pates, sauce tomate, tomate, viande", // Exemple d'ID d'ingrédients
                'instructions' => 'Faites cuire les pâtes. Préparez la sauce à la viande en mélangeant la viande hachée et la sauce tomate. Servez sur les pâtes.',
                'prep_time' => 15,
                'cook_time' => 30,
                'servings' => 4,
                'calories' => 420,
            ]
        ];

        foreach($recipesData as $recipe) {
            Recipes::create($recipe);
        }
        return response()->json(['Recipes' => $recipesData]);
    }
}
