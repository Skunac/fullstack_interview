<template>
    <v-card  id="card" class="my-10 mx-auto w-50 px-5 py-5 elevation-10 rounded-lg " min-width="400" min-height="750">
        <div class="button-container">
            <RouterLink :to="{ path : '/'}"><v-btn class="mx-4" rounded="lg" size="x-large" color="grey-lighten-2">Back to home</v-btn></RouterLink>
        </div>
        <v-form>
            <v-text-field v-model="name" label="Title" variant="underlined"></v-text-field>
            <v-text-field v-model="description" label="Description" variant="underlined"></v-text-field>
            <v-textarea v-model="instructions" label="Instructions" bg-color="grey-lighten-2" variant="solo-filled"></v-textarea>
            <v-text-field v-model="ingredients" label="Ingredients" variant="underlined"></v-text-field>
            <div>
                <div class="text-caption">Preparation time</div>
                <v-slider v-model="prep_time" step="5" min="0" max="60" thumb-label show-ticks></v-slider>
            </div>
            <div>
                <div class="text-caption">Cooking time</div>
                <v-slider v-model="cook_time" step="5" min="0" max="60"  thumb-label show-ticks></v-slider>
            </div>
            <div>
                <div class="text-caption">Servings</div>
                <v-slider v-model="servings" step="1" min="0" max="12"  thumb-label show-ticks></v-slider>
            </div>
            <v-text-field v-model="calories" label="Calories" variant="underlined"></v-text-field>
            <v-btn block @click="submitForm" color="grey-lighten-2">Submit</v-btn>
        </v-form>
    </v-card>
</template>

<style>
@import '../css/CreateRecipe.css';
</style>

<script>
import axios from 'axios';

export default {
    data () {
        return {
            name : '',
            description: '',
            instructions: '',
            ingredients: '',
            prep_time: 0,
            cook_time: 0,
            servings: 0,
            calories: 0
        }

    },
    created() {
        document.title= "Recipe creation";
    },
    methods: {
        submitForm() {
            const data = {
                title: this.name,
                description: this.description,
                instructions: this.instructions,
                ingredients: this.ingredients,
                prep_time: this.prep_time,
                cook_time: this.cook_time,
                servings: this.servings,
                calories: this.calories
            };
            const url = 'http://localhost:8000/api/recipies/';
            axios({
                method: 'POST',
                url: url,
                data: data,
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