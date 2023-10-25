<template>
    <div v-if="recipesToDisplay.length > 0">
        <v-card class="my-3" v-for="recipe in recipesToDisplay" :key="recipe.id">
            <v-container class="py-4 cards">
                <v-card-title>
                    {{ recipe.title }}
                    </v-card-title>
                    <div class="recipe-subtitle">
                    <div class="recipe-ingredients">
                        <v-card-subtitle class="ingredient-text">
                        {{ recipe.ingredients }}
                        </v-card-subtitle>
                    </div>
                    <div>
                        <v-card-subtitle class="total-time">
                        {{ recipe.total_time }} min
                        </v-card-subtitle>
                    </div>
                    </div>
                <v-btn :icon="getIcon(recipe.id)" @click="toggleCard(recipe.id)"></v-btn>
                <v-expand-transition class="py-3">
                    <div v-show="recipe.show">  
                        <v-divider></v-divider>
                        <v-card-item>
                            <v-card-text>
                                {{ recipe.description }}
                            </v-card-text>
                            <v-card-text>
                                {{ recipe.instructions }}
                            </v-card-text>
                            <v-card-text>
                            <div>
                                Preparation: {{ recipe.prep_time }}
                            </div>
                            <div>
                                Cooking: {{ recipe.cook_time }}   
                            </div>
                            <div>
                                Servings: {{ recipe.servings }}
                            </div>
                            <div>
                                Calories: {{ recipe.calories }}
                            </div>
                            </v-card-text>
                        </v-card-item>
                        <router-link :to="{ name: 'modifyRecipe', query: { recipeData: JSON.stringify(recipe) }}">
                            <v-btn class="mx-4" rounded="sm" size="large" variant="tonal">Modify this recipe</v-btn>
                        </router-link>
                        <v-btn class="mx-4" rounded="sm" size="large" variant="tonal" id="deleteBtn" @click="deleteRecipe(recipe.id)">Delete this recipe</v-btn>
                    </div>
                </v-expand-transition>
            </v-container>
        </v-card>
    </div>
    <div v-else>
        <div v-if="searchBarInput === '' ">
            <NoRecipesAvailable />
        </div>
        <div v-else>
            <NoRecipesMatch />
        </div>
    </div>
</template>

<style>
    @import '../css/RecipeList.css';
</style>

<script>
import NoRecipesAvailable from './NoRecipesAvailable.vue';
import NoRecipesMatch from './NoRecipesMatch.vue';
export default {
    props: {
        searchBarInput: String,
        recipes: Array
    },
    emits: ['delete'],
    computed: {
        recipesToDisplay() {
            if (this.searchBarInput.trim() !== "") {
                return this.recipes.filter((recipe) => {
                    return recipe.ingredients.toLowerCase().includes(this.searchBarInput.toLowerCase());
                });
            }
            else {
                return this.recipes;
            }
        }
    },
    methods: {
        deleteRecipe(id) {
            const index = this.recipes.findIndex(recipe => recipe.id === id);
            if (index !== -1) {
                this.$emit('delete', this.recipes[index]);
            }
        },
        toggleCard(id) {
            const recipe = this.recipes.find(recipe => recipe.id === id);
            if (recipe) {
                recipe.show = !recipe.show;
            }
        },
        getIcon(id) {
            let recipe;
            if (this.searchBarInput === "") {
                recipe = this.recipes.find(recipe => recipe.id === id);
            }
            if (recipe) {
                return recipe.show ? 'mdi-chevron-up' : 'mdi-chevron-down';
            }
            return 'mdi-chevron-down';
        }
    },
    components: { NoRecipesMatch, NoRecipesAvailable }
}
</script>