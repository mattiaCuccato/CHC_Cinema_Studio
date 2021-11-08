<template>
    <div class="w-full px-12 grid grid-cols-5 bg-black">
        <div v-for="(film, index) in films" :key="index" class="flex p-2">
            <img @click="goToFilmDetail(film)" :src="film.poster" :alt="film.title" class="">
        </div>
    </div>
</template>

<script>
import axios from "axios";


export default {
    name: "FilmsList",
    data() {
        return{
            films: [],
            isLoading: true
        }
    },
    async mounted() {
        this.isLoading = true;
        let response = await axios.get("http://localhost:8000/api/movies");
        this.films = response.data;
        this.isLoading = false;
    },
    methods: {
        goToFilmDetail(film) {
        this.$router.push("/films/detail/" + film.id);
        },
    }
}
</script>