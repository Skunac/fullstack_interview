<template>
    <div style="background-color: red;">
        <h1>Recipes</h1>
        <ul v-if="recipes.length > 0">
            <li v-for="recipe in recipes" :key="recipe.id">{{ recipe.title }}</li>
        </ul>
        <p v-else>No recipes available.</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
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
};
</script>