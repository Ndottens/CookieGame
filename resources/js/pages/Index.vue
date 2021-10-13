<template>
    <div class="row">
        <div class="col-md-8">
            <recipe-component></recipe-component>
        </div>
        <div class="col-md-4">
            <leaderboard/>
        </div>
    </div>
</template>

<script>
    import RecipeComponent from '../components/RecipeComponent'
    import Leaderboard from '../components/Leaderboard'

    export default {
        name: 'Index',
        data() {
          return {
              recipes: null,
          }
        },
        components: {
            Leaderboard,
            RecipeComponent
        },
        mounted() {
        }
    }
</script>
