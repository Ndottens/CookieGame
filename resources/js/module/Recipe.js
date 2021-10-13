import axios from 'axios'
const url = 'http://127.0.0.1:8000/api/'

export default class Recipe {

    static getIngredients() {
        return axios.get(url + 'ingredients')
    }

    static getScore(form) {
        return axios.post(url + 'score', form)
    }

    static getLeaderboard() {
        return axios.get(url + 'leaderboard')
    }
}
