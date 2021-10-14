<template>
        <div class="row">
            <div class="col-md-12">
                <p class="font-italic h3 ml-2">Cookie Maker</p>
            </div>
            <div class="col-md-6" v-for="ingredient in ingredients">
                <div class="card border-0">
                    <img class="card-img-top" :src="'http://127.0.0.1:8000/storage/' + ingredient.name + '.jpg'"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ capitalize(ingredient.name) }}</h5>
                        <div class="row mb-2">
                            <div class="col-md-6 font-italic">
                                <p class="card-text mr-2 mb-0">Capacity: <span
                                    class="font-weight-bold">{{ ingredient.capacity }}</span></p>
                                <p class="card-text mr-2 mt-0 mb-0">Durability: <span
                                    class="font-weight-bold">{{ ingredient.durability }}</span></p>
                                <p class="card-text mr-2 mt-0">Taste: <span
                                    class="font-weight-bold">{{ ingredient.taste }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text mr-2 mb-0">Texture: <span
                                    class="font-weight-bold">{{ ingredient.texture }}</span></p>
                                <p class="card-text mr-2 mt-0">Calories: <span
                                    class="font-weight-bold">{{ ingredient.calories }}</span></p>
                            </div>
                        </div>

                        <label :for="ingredient.name" class="font-italic">Teaspoons</label>
                        <input type="number" class="form-control" :id="ingredient.name"
                               placeholder="Enter the amount of tea spoons" v-model="form[ingredient.name]">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button type="button" @click="submit" class="btn btn-sm btn-success mt-2 float-right">Submit</button>
            </div>
        </div>
</template>

<script>
import Recipe from '../module/Recipe'

export default {
    name: 'RecipeComponent',
    data() {
        return {
            ingredients: null,
            form: {}
        }
    },
    methods: {
        capitalize(name) {
            return name[0].toUpperCase() + name.slice(1);
        },

        getIngredients() {
            Recipe.getIngredients().then(({data}) => {
                this.ingredients = data
                this.ingredients.forEach((ingredient) => {
                    this.form[ingredient.name] = 0;
                })
            }).catch((error) => {
                this.$root.$emit('error', error.response.data)
            })
        },

        submit() {
            Recipe.getScore(this.form).then(({ data }) => {
                this.$root.$emit('success', data.message)
                this.$root.$emit('reloadLeaderboard')
            }).catch((error) => {
               this.$root.$emit('error', error.response.data)
            })
        }
    },
    mounted() {
        this.getIngredients()
    }
}
</script>
