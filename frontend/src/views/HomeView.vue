<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
    <v-container>
        <v-row>
            <v-text-field v-model="searchBarInput" prepend-icon="mdi-magnify" single-line></v-text-field>
            <RouterLink :to="{ path : '/create'}"><v-btn class="mx-4" rounded="lg" size="x-large">Create a recipe</v-btn></RouterLink>
        </v-row>
            <div v-if="recipes.length > 0">
                <RecipeList :recipes="recipes" :searchBarInput="searchBarInput" @delete="handleRecipeDelete"/>
            </div>
            <div v-else>
                <NoRecipesAvailable />
            </div>
    </v-container>
</template>

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
        instance.get('/recipies')
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
            instance.delete(`/recipe/${recipe.id}`)
            .then(response => {
                if (response.status === 204) {
                    this.recipes = this.recipes.filter(r=> r.id !== recipe.id)
                }
            })
            .catch(error => {
                console.error('Error deleting recipe:', error);
            });
    }
    }
};
</script>
