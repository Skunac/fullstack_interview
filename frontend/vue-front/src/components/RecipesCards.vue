<template>
        <v-card v-for="recipe in recipes" :key="recipe.id">
            <v-container class="py-3">
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
                    </div>
                </v-expand-transition>
            </v-container>
        </v-card>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            show: false,
            recipes: [] // Define 'recipes' as a data property
        };
    },
    created() {
        const instance = axios.create({
            baseURL: 'http://localhost:8000'
        });
        instance.get('/recipies') // Update the API endpoint to fetch recipes
        .then(response => {
            this.recipes = response.data.Recipes; // Set 'this.recipes' with the fetched data
            console.log(this.recipes);
        })
        .catch(error => {
            console.error('Error fetching recipes:', error);
        });
    },
    methods: {
        toggleCard(id) {
            const recipe = this.recipes.find(recipe => recipe.id === id);
            if (recipe) {
                recipe.show = !recipe.show;
            }
        },
        getIcon(id) {
            const recipe = this.recipes.find(recipe => recipe.id === id);
            return recipe.show ? 'mdi-chevron-up' : 'mdi-chevron-down';
        }
    }
};
</script>