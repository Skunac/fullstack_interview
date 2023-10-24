<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
    <v-container>
        <v-row>
            <v-text-field v-model="searchBarInput" @input="filterRecipes" prepend-icon="mdi-magnify" single-line></v-text-field>
            <RouterLink :to="{ path : '/create'}"><v-btn class="mx-4" rounded="lg" size="x-large">Create a recipe</v-btn></RouterLink>
        </v-row>
        <div v-if="searchBarInput === '' ? recipes : filteredRecipes.length > 0">
            <div v-if="recipes.length > 0">
                <v-card class="my-3" v-for="recipe in searchBarInput === '' ? recipes : filteredRecipes" :key="recipe.id">
                    <v-container class="py-4">
                        <v-card-title>
                            {{ recipe.title }}
                        </v-card-title>
                        <v-card-subtitle>
                            {{ recipe.ingredients }}
                        </v-card-subtitle>
                        <v-btn :icon="getIcon(recipe.id)" @click="toggleCard(recipe.id)"></v-btn>
                        <v-expand-transition class="py-3">
                            <div v-show="recipe.show">
                                <v-divider></v-divider>
                                <v-card-item>
                                    {{ recipe.description }}
                                    <v-card-text>
                                    <div>
                                        Prep time: {{ recipe.prep_time }}
                                    </div>
                                    <div>
                                        Cook time: {{ recipe.cook_time }}   
                                    </div>
                                    <div>
                                        Total time: {{ recipe.total_time }}
                                    </div>
                                    <div>
                                        Servings: {{ recipe.servings }}
                                    </div>
                                    <div>
                                        Calories: {{ recipe.calories }}
                                    </div>
                                    </v-card-text>
                                </v-card-item>
                                <v-btn class="mx-4" rounded="sm" size="large" variant="tonal" color="red-darken-1" @click="deleteRecipe(recipe.id)">Delete this recipe</v-btn>
                                <router-link :to="{ name: 'modifyRecipe', query: { recipeData: JSON.stringify(recipe) }}">
                                    <v-btn class="mx-4" rounded="sm" size="large" variant="tonal">Modify this recipe</v-btn>
                                </router-link>
                            </div>
                        </v-expand-transition>
                    </v-container>
                </v-card>
            </div>
            <div v-else>
                <v-card class="my-3">
                    <v-container class="py-4">
                        <v-card-title>No recipes found</v-card-title>
                    </v-container>
                </v-card>
            </div>
        </div>
        <div v-else>
            <v-card class="my-3">
                <v-container class="py-4">
                    <v-card-title>No matching recipes found</v-card-title>
                </v-container>
            </v-card>
        </div>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    data() {
    return {
        show: false,
        recipes: [],
        searchBarInput: "",
        filteredRecipes: [],
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
    filterRecipes() {
        if (this.searchBarInput !== "") {
            this.filteredRecipes = this.recipes.filter((recipe) => {
            return recipe.title.toLowerCase().includes(this.searchBarInput.toLowerCase());
        });
        } else {
            this.filteredRecipes = [];
        }
    },
    deleteRecipe(id) {
        const recipe = this.searchBarInput === "" ? (this.recipes.find(recipe => recipe.id === id)) : (this.filteredRecipes.find(recipe => recipe.id === id));
        if (recipe) {
            const instance = axios.create({
                baseURL: 'http://localhost:8000'
            });
            instance.delete(`/recipe/${recipe.id}`)
            .then(response => {
                if (response.status === 204) {
                    this.recipes = this.recipes.filter(r => r.id !== recipe.id);
                    this.filteredRecipes = this.filteredRecipes.filter(r => r.id !== recipe.id);
                }
            })
            .catch(error => {
                console.error('Error deleting recipe:', error);
            });
        }
    },
    toggleCard(id) {
            const recipe = this.searchBarInput === "" ? (this.recipes.find(recipe => recipe.id === id)) : (this.filteredRecipes.find(recipe => recipe.id === id));
            if (recipe) {
                recipe.show = !recipe.show;
            }
        },
    getIcon(id) {
            const recipe = this.searchBarInput === "" ? (this.recipes.find(recipe => recipe.id === id)) : (this.filteredRecipes.find(recipe => recipe.id === id));
            return recipe.show ? 'mdi-chevron-up' : 'mdi-chevron-down';
        }
    }
};
</script>
