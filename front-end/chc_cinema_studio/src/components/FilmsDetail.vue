<template>
    <div class="w-full min-h-screen max-w-screen-md mx-auto flex flex-col">
        <div class="flex flex-row p-5 items-center">
            <div class="text-xl font-bold pr-5">
                {{ film.title }}
            </div>
            <div class="pr-5">
                {{ film.rating }}
            </div>
            <div class="pr-5">
                {{ film.running_time }}
            </div>
        </div>
        
        <div class="col-span-5">
            <img :src="film.img" :alt="film.title" class="w-screen">
        </div>
        <div class="my-2">
            Regista: {{ film.director }}
        </div>
        <div class="mb-2">
            Cast: {{ film.cast }}
        </div>
        <div class="mb-2">
            Genere: {{ film.genre }}
        </div>
        <div class="text-sm">
            {{ film.plot }}
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      film: null
    };
  },
  async mounted() {
    let filmId = this.$route.params.id;
    let response = await axios.get("http://localhost:8000/api/movies/" + filmId);

    this.film = response.data;
  }
};
</script>