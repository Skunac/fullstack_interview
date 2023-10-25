<template>
    <v-card  id="card" class="my-10 mx-auto w-50 px-5 py-5 elevation-10 rounded-lg " min-width="400" min-height="750">
        <div class="button-container">
            <RouterLink :to="{ path : '/'}"><v-btn class="mx-4" rounded="lg" size="x-large" color="grey-lighten-2">Back to home</v-btn></RouterLink>
        </div>
        <v-form>
            <v-text-field v-model="recipe.title" label="Title" variant="underlined"></v-text-field>
            <v-text-field v-model="recipe.description" label="Description" variant="underlined"></v-text-field>
            <v-textarea v-model="recipe.instructions" label="Instructions" variant="solo-filled" bg-color="grey-lighten-2"></v-textarea>
            <v-text-field v-model="recipe.ingredients" label="Ingredients" variant="underlined"></v-text-field>
            <div>
                <div class="text-caption">Preparation time</div>
                <v-slider v-model="recipe.prep_time" step="5" min="0" max="60" show-ticks></v-slider>
            </div>
            <div>
                <div class="text-caption">Cooking time</div>
                <v-slider v-model="recipe.cook_time" step="5" min="0" max="60"  show-ticks></v-slider>
            </div>
            <div>
                <div class="text-caption">Servings</div>
                <v-slider v-model="recipe.servings" step="1" min="0" max="12"  show-ticks></v-slider>
            </div>
            <v-text-field v-model="recipe.calories" label="Calories" variant="underlined"></v-text-field>
            <v-btn block @click="submitForm" color="grey-lighten-2">Submit</v-btn>
        </v-form>
    </v-card>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            recipe : {}
        };
    },
    created(){
        const recipe = this.$route.query.recipeData;
        if (recipe) {
            this.recipe = JSON.parse(recipe);
        }
        document.title= "Recipe modification";
    },
    methods: {
        submitForm(){
            const url = `http://localhost:8000/api/recipe/${this.recipe.id}`;
            axios({
                method: 'PUT',
                url: url,
                data: this.recipe,
                headers: {
                    'Content-Type':'application/json'
                }
            })
            .then(function (response) {
                window.location.href="/";
            })
            .catch(function (error) {
                if (error.response) {
                    console.error('Request failed with status:', error.response.status);
                    console.error('Response Data:', error.response.data);
                } else {
                    console.error('Network error occurred:', error.message);
                }
            });
        }
    }
}
</script>
