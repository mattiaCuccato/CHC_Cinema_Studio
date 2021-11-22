<template>
    <div class="w-full px-12 grid grid-cols-5 bg-black">
        <div v-for="(projection, index) in projections" :key="index" class="flex p-2">
            <div class="flex flex-col p-5 items-center"  @click="goToRoom(room)">
                <div class="text-xl font-bold pr-5">
                    {{ projection.date }}
                </div>
                <div class="pr-5">
                    {{ projection.room.name }}
                </div>
                <!--
                    <div class="pr-5">
                    {{ projection.film.title }}
                    </div>
                -->
            </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "ProjectionsList",
    data() {
        return{
            projections: [],
            isLoading: true
        }
    },
    async mounted() {
        /*this.isLoading = true;
        let response = await axios.get("http://localhost:8000/api/films");
        this.films = response.data;
        this.isLoading = false;*/
        this.isLoading = true;
        let response = await axios.get("http://localhost:3001/projections");
        this.projections = response.data;
        this.isLoading = false;
    },

    /*
    methods: {
        goToRoom(room) {
            DA RIGUARDARE 
        this.$router.push("/projections/detail/" + room.id);
        },
    }
    */
}
</script>