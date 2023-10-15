<template>
  <v-app>
    <v-main>
      <v-container>
        <v-card>
          <v-card-actions>
            <v-text-field
            label="Enter title here"
            variant="outlined">
            </v-text-field>
            <v-btn>Créer une recette</v-btn>
          </v-card-actions>
          <v-card-item>
            <RecipesCards />
          </v-card-item>
        </v-card>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import RecipesCards from './components/RecipesCards.vue';

export default {
  name: 'App',

  components: {
    RecipesCards,
  },

  data: () => ({
    //
  }),
}
</script> 