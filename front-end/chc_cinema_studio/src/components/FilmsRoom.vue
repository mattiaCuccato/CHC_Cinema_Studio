<template>
    <div class="w-full px-12 grid grid-cols-5 bg-black">
        <div v-for="(film, index) in films" :key="index" class="flex p-2">
            <img @click="goToFilmDetail(film)" :src="film.poster" :alt="film.title" class="">
        </div>
    </div>
</template>

<script>


export default {
    name: "FilmsRoom",
}
</script>