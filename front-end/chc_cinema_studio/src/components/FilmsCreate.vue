<template>
  <div class="px-12 bg-black">
    <h1 class="text-center text-2xl mb-5 font-bold  mt-16">Inserisci un nuovo Film</h1>
    <div class="flex">
      <div class="flex flex-col flex-grow">
        <div
          class="grid grid-cols-3 mb-3 gap-5"
          v-for="(field, index) in formFields"
          :key="index"
        >
          <label
            :for="field.code"
            class="flex items-center justify-end font-bold text-white text-xl mb-4"
          >
            {{ field.label }}:
          </label>
          <div class="flex-grow text-black">
            <div v-if="field.type == 'text'">
              <input
                :id="field.code"
                :placeholder="field.placeholder"
                class="flex-grow p-2 px-3 rounded focus:outline-none w-full"
                type="text"
                v-model="newFilm[field.code]"
              />
            </div>
            <div v-if="field.type == 'checkbox'">
              <input
                :id="field.code"
                class="p-2 px-3 rounded focus:outline-none"
                type="checkbox"
                v-model="newFilm[field.code]"
              />
            </div>
            <div v-if="field.type == 'textarea'">
              <textarea
                v-model="newFilm[field.code]"
                :name="field.code"
                :id="field.code"
                class="flex-grow p-2 px-3 rounded focus:outline-none w-full h-32"
                cols="30"
                rows="10"
                :placeholder="field.placeholder"
              ></textarea>
            </div>
            <div v-if="field.type == 'select'">
              <select
                class="flex-grow p-2 px-3 rounded  focus:outline-none w-full"
                :name="field.code"
                :id="field.code"
                v-model="newFilm[field.code]"
              >
                <option
                  v-for="option in field.options"
                  :key="option.value"
                  :value="option.value"
                >
                  {{ option.label }}
                </option>
              </select>
            </div>
            <div v-if="field.type == 'number'">
              <input
                :id="field.code"
                :placeholder="field.placeholder"
                class="flex-grow p-2 px-3 rounded focus:outline-none w-full"
                type="number"
                v-model="newFilm[field.code]"
              />
            </div>
          </div>
          <div
            class="flex items-center px-3 text-red-600"
            v-if="field.required"
          >
            <span v-if="!newFilm[field.code]">
              Questo campo è obbligatorio
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="flex items-center justify-center py-5 text-xl">
      <button
        :disabled="!isFormValid"
        :class="{
          'bg-green-500 cursor-pointer': isFormValid,
          'bg-red-600 cursor-not-allowed': !isFormValid
        }"
        class="px-3 py-1 rounded"
        @click="saveFilm()"
      >
        Inserisci film
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      isEdit: false,
      newFilm: {
        title: "",
        /*director: "",
        cast: "",*/
        year: 2000,
        /*genre: "",*/
        duration: "",
        plot: "",
        rating: "",
        poster: "",
        image: ""
      },
      formFields: [
        {
          code: "title",
          label: "Titolo Film",
          type: "text",
          placeholder:"Inserisci il titolo",
          required: true,
        },
        /*{
          code: "director",
          label: "Regista",
          type: "text",
          placeholder:"Inserisci il nome e cognome del regista",
          required: true,
        },
        {
          code: "cast",
          label: "Cast",
          type: "text",
          placeholder:"Inserisci il nome e cognome dei principali attori",
          required: true,
        },*/
        {
          code: "year",
          label: "Anno",
          type: "number",
          placeholder:"Inserisci l'anno di uscita del film",
          required: true,
        },
        /*{
          code: "genre",
          label: "Genere",
          type: "text",
          placeholder:"Inserisci il genere",
          required: true,
        },*/
        {
          code: "duration",
          label: "Durata",
          type: "number",
          placeholder:"Inserisci la durata in minuti",
          required: true,
        },
        {
          code: "plot",
          label: "Trama",
          type: "textarea",
          placeholder:"Inserisci la trama",
          required: true,
        },
        {
          code: "rating",
          label: "Rating",
          type: "text",
          placeholder:"Inserisci il rating",
          required: true,
        },
        {
          code: "image",
          label: "Immagine",
          type: "text",
          placeholder:"Inserisci l'url dell'immagine",
          required: true,
        },
        {
          code: "poster",
          label: "Locandina",
          type: "text",
          placeholder:"Inserisci l'url della locandina",
          required: true,
        },
      ]
    };
  },
  async mounted() {
    if (this.$route.name == "films_edit") {
      this.isEdit = true;
      let filmId = this.$route.params.id;
      let response = await axios.get("http://localhost:8000/api/film/create" + filmId);
      this.newFilm = response.data;
      console.log(this.newFilm);
    }
  },
  methods: {
    async saveFilm() {
      let response;

      response = await axios.post("http://localhost:8000/api/film/create", this.newFilm);

      console.log(response.data);

      this.$router.push("/films/list");
    }
  },
  computed: {
    isFormValid() {
      let formIsValid = true;

      this.formFields.forEach(field => {
        if (field.required) {
          formIsValid = formIsValid && !!this.newFilm[field.code];
        }
      });

      return formIsValid;
    }
  }
};
</script>
