<template>
    <div v-if="showRecipes && recipesToDisplay.length > 0">
        <v-card class="my-3" v-for="recipe in recipesToDisplay" :key="recipe.id">
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
        <div v-if="searchBarInput === '' ">
            <NoRecipesAvailable />
        </div>
        <div v-else>
            <NoRecipesMatch />
        </div>
    </div>
</template>

<script>
import NoRecipesAvailable from './NoRecipesAvailable.vue';
import NoRecipesMatch from './NoRecipesMatch.vue';
export default {
    data() {
        return {
            showRecipes: true
        }
    },
    props: {
        searchBarInput: String,
        recipes: Array
    },
    emits: ['delete'],
    computed: {
        recipesToDisplay() {
            if (this.searchBarInput.trim() !== "") {
                return this.recipes.filter((recipe) => {
                    return recipe.title.toLowerCase().includes(this.searchBarInput.toLowerCase());
                });
            }
            else {
                return this.recipes;
            }
        }
    },
    methods: {
        deleteRecipe(id) {
            const recipe = this.recipes.find(recipe => recipe.id === id);
            if (recipe) {
                this.$emit('delete', recipe);
                this.showRecipes = false;
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