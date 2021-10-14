<template>
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic h3 ml-2">Leaderboard</p>
        </div>
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="card-header border-0"  style="background-color: rgb(103 103 103 / 3%)">
                        <div class="row mb-0">
                            <div class="col-md-2">
                                <span class="font-weight-bold">Nr.</span>
                            </div>
                            <div class="col-md-7">
                                <span class="font-weight-bold">Score</span>
                            </div>
                            <div class="col-md-3">
                                <span class="font-weight-bold">%</span>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item border-0" v-for="(recipe, index) in recipes" v-if="recipes">
                            <div class="row">
                                <div class="col-md-2">
                                    <p class="custom-margin font-weight-bold"><span class="badge badge-success text-white">{{ index + 1 }}</span> </p>
                                </div>
                                <div class="col-md-7">
                                    <p class="custom-margin font-weight-bold">{{ recipe.score }}.</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="custom-margin font-weight-bold">{{ recipe.percentScore.toFixed(0) }}%</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.custom-margin {
    margin-top: 0.7rem !important;
}
</style>

<script>
    import Recipe from '../module/Recipe'

    export default {
        name: 'Leaderboard',
        data() {
            return {
                recipes: null
            }
        },
        methods: {
            LoadLeaderboard() {
                Recipe.getLeaderboard().then(({ data }) => {
                    this.recipes = data
                }).catch((error) => [
                    this.$root.$emit('error', error.response.data)
                ])
            }
        },
        mounted() {
            this.LoadLeaderboard()
            this.$root.$on('reloadLeaderboard', () =>{
                this.LoadLeaderboard()
            })
        }
    }
</script>
