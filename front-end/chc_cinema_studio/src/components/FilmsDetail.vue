<template>
  <div class="w-full min-h-screen max-w-screen-md mx-auto flex flex-col">
    <div class="flex flex-row p-5 items-center">
      <div class="text-xl font-bold pr-5">
        {{ film.title }}
      </div>
      <div class="pr-5">
        {{ film.rating }}
      </div>
      <div class="pr-5">{{ film.duration }} min.</div>
    </div>

    <div class="col-span-5">
      <img :src="film.img" :alt="film.title" class="w-screen" />
    </div>
    <div class="text-sm">
      {{ film.plot }}
    </div>

    <div class="flex justify-center m-10">
      <div v-for="(projection, index) in film.projections" :key="index">
        <div
          class="
            flex flex-col
            p-2
            m-2
            items-center
            text-center text-sm
            border
            rounded-lg
          "
          @click="goToProjection(projection)"
        >
          <div class="font-bold">
            {{ projection.date }}
          </div>
          <div class="">
            {{ projection.room.name }}
          </div>
          <!--<div class="pr-5">
                    {{ projection.film.title }}
                    </div>
                -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      film: null,
      projection: null,
      projections: [],
      rooms: [],
    };
  },
  async mounted() {
    /*let filmId = this.$route.params.id;
    let responseFilm = await axios.get("http://localhost:3001/films/" + filmId);*/

    let filmId = this.$route.params.id;
    let responseFilm = await axios.get("http://localhost:8000/api/film/detail/" + filmId);

    this.film = responseFilm.data;

  },
  methods: {
    goToProjection(projection) {
      this.$router.push("/films/projection/" + projection.id);
    },
  },
};
</script>