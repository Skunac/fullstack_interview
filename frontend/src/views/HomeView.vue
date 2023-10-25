<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
    <v-card id="card" class="my-10 mx-auto w-50 px-5 py-5 elevation-10 rounded-lg" min-width="400" min-height="750">
        <v-row>
            <v-text-field v-model="searchBarInput" prepend-icon="mdi-magnify" single-line></v-text-field>
            <RouterLink :to="{ path : '/create'}"><v-btn class="mx-4" rounded="lg" color="grey-lighten-2" size="x-large">Create a recipe</v-btn></RouterLink>
        </v-row>
            <div v-if="recipes.length > 0">
                <RecipeList :recipes="recipes" :searchBarInput="searchBarInput" @delete="handleRecipeDelete"/>
            </div>
            <div v-else>
                <NoRecipesAvailable />
            </div>
    </v-card>
</template>

<style>
    @import '../css/HomeView.css';
</style>

<script>
import axios from 'axios';
import RecipeList from '@/components/RecipeList.vue';
import NoRecipesAvailable from '@/components/NoRecipesAvailable.vue';

export default {
    data() {
    return {
        recipes: [],
        searchBarInput: "",
    };
    },
    created() {
    const instance = axios.create({baseURL: 'http://localhost:8000'});
        instance.get('/api/recipies')
        .then((response) => {
            this.recipes = response.data.Recipes;
        })
        .catch((error) => {
            console.error('Error fetching recipes:', error);
        });
    },
    methods: {
    handleRecipeDelete(recipe){
        const instance = axios.create({
                baseURL: 'http://localhost:8000'
            });
            instance.delete(`/api/recipe/${recipe.id}`)
            .then(response => {
                if (response.status === 204) {
                    this.recipes = this.recipes.filter(r=> r.id !== recipe.id);
                }
            })
            .catch(error => {
                console.error('Error deleting recipe:', error);
            });
    }
    },
    components : {
        RecipeList,
        NoRecipesAvailable
    }
};
</script>
