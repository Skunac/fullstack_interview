<template>
    <p>Recipe Data: {{ this.recipe.title }}</p>
</template>

<script>
export default {
    data() {
        return {
            recipe : {}
        };
    },
    created(){
        const recipe = this.$route.query.recipeData;
        if (recipe) {
            this.recipe = JSON.parse(recipe);
            console.log(this.recipe.title);
        }
    },
    methods: {

    }
}
</script>
