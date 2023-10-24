<template>
    <v-container>
        <div class="button-container">
            <RouterLink :to="{ path : '/'}"><v-btn class="mx-4" rounded="lg" size="x-large">Back to home</v-btn></RouterLink>
        </div>
        <v-form>
            <v-text-field v-model="name" label="Name" variant="underlined"></v-text-field>
            <v-text-field v-model="description" label="Description" variant="underlined"></v-text-field>
            <v-textarea v-model="instructions" label="Instructions" variant="solo-filled"></v-textarea>
            <v-text-field v-model="ingredients" label="Ingredients" variant="underlined"></v-text-field>
            <div>
                <div class="text-caption">Preparation time</div>
                <v-slider v-model="prep_time" step="5" min="0" max="60" show-ticks></v-slider>
            </div>
            <div>
                <div class="text-caption">Cooking time</div>
                <v-slider v-model="cook_time" step="5" min="0" max="60"  show-ticks></v-slider>
            </div>
            <div>
                <div class="text-caption">Servings</div>
                <v-slider v-model="servings" step="1" min="0" max="12"  show-ticks></v-slider>
            </div>
            <v-text-field v-model="calories" label="Calories" variant="underlined"></v-text-field>
            <v-btn block @click="submitForm">Submit</v-btn>
        </v-form>
    </v-container>
</template>

<style scoped>
.button-container {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.back-button {
    margin-top: 16px; /* Adjust margin as needed */
}
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
            const url = 'http://localhost:8000/recipies/';
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