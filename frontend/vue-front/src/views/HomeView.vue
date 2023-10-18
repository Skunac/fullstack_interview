<script setup>
import RecipesCards from '@/components/RecipesCards.vue';
import { RouterLink } from 'vue-router';


</script>

<template>
    <v-card color="brown-lighten-3">
        <v-container>
            <v-row>
                <v-text-field class="mx-4" label="Entrer une recherche ici" single-line variant="outlined"></v-text-field>
                <RouterLink :to="{ path : '/create'}"><v-btn class="mx-4" rounded="lg" size="x-large">Créer une recette</v-btn></RouterLink>
            </v-row>
        </v-container>
        <v-container>
            <RecipesCards />
        </v-container>
    </v-card>
</template>