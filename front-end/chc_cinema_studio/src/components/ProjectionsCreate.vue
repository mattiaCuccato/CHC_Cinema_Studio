<template>
  <div class="px-12 bg-black">
    <h1 class="text-center text-2xl mb-5 font-bold">Inserisci una nuova Proiezione</h1>
    <div class="flex">
      <div class="flex flex-col flex-grow">
        <div
          class="grid grid-cols-3 mb-3 gap-5"
          v-for="(field, index) in formFields"
          :key="index"
        >
          <label
            :for="field.code"
            class="flex items-center font-bold text-white text-xl"
          >
            {{ field.label }}
          </label>
          <div class="flex-grow text-black">
            <div v-if="field.type == 'text'">
              <input
                :id="field.code"
                :placeholder="field.placeholder"
                class="flex-grow p-2 px-3 rounded focus:outline-none w-full"
                type="text"
                v-model="newProjection[field.code]"
              />
            </div>
            <div v-if="field.type == 'date'">
              <input
                :id="field.code"
                :placeholder="field.placeholder"
                class="flex-grow p-2 px-3 rounded focus:outline-none w-full"
                type="datetime-local"
                v-model="newProjection[field.code]"
              />
            </div>
            <div v-if="field.type == 'checkbox'">
              <input
                :id="field.code"
                class="p-2 px-3 rounded focus:outline-none"
                type="checkbox"
                v-model="newProjection[field.code]"
              />
            </div>
            <div v-if="field.type == 'textarea'">
              <textarea
                v-model="newProjection[field.code]"
                :name="field.code"
                :id="field.code"
                class="flex-grow p-2 px-3 rounded focus:outline-none w-full h-32"
                :placeholder="field.placeholder"
              ></textarea>
            </div>
            <div v-if="field.type == 'select'">
              <select
                class="flex-grow p-2 px-3 rounded  focus:outline-none w-full"
                :name="field.code"
                :id="field.code"
                :placeholder="field.placeholder"
                v-model="newProjection[field.code]"
              >
                <option
                  v-for="option in options[field.code]"
                  :key="option[field.optionField]"
                  :value="option[field.optionField]"
                >
                  {{ option[field.optionLabel] }}
                </option>
              </select>
            </div>
            <div v-if="field.type == 'number'">
              <input
                :id="field.code"
                :placeholder="field.placeholder"
                class="flex-grow p-2 px-3 rounded focus:outline-none w-full"
                type="number"
                v-model="newProjection[field.code]"
              />
            </div>
          </div>
          <div
            class="flex items-center px-3 text-red-600"
            v-if="field.required"
          >
            <span v-if="!newProjection[field.code]">
              Questo campo è obbligatorio
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5 text-xl">
      <button
        :disabled="!isFormValid"
        :class="{
          'bg-green-500 cursor-pointer': isFormValid,
          'bg-red-600 cursor-not-allowed': !isFormValid
        }"
        class="px-3 py-1 rounded"
        @click="saveProjection()"
      >
        Inserisci Proiezione
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      options: {
        "film_id": [],
        "room_id": []
      },
      newProjection: {
          film_id: 0,
          room_id: 0,
          date: "",
      },
      formFields: [
        {
          code: "film_id",
          label: "Film della proiezione",
          type: "select",
          optionField: "id",
          optionLabel: "title",
          placeholder: "Inserisci film della proiezione",
          required: true,
        },
        {
          code: "room_id",
          label: "Stanza della proiezione",
          type: "select",
          optionField: "id",
          optionLabel: "name",
          placeholder: "Inserisci stanza della proiezione",
          required: true,
        },
        {
          code: "date",
          label: "Data e orario della proiezione",
          type: "date",
          placeholder:"yyyy-mm-gg hh-mm-ss",
          required: true,
        },
      ]
    };
  },

  async mounted() {
      let responseFilms = await axios.get("http://localhost:8000/api/films");
      this.options.film_id = responseFilms.data;
      

      let responseRooms = await axios.get("http://localhost:8000/api/rooms");
      this.options.room_id = responseRooms.data;


  },

  methods: {
    async saveProjection() {
      let response;

      response = await axios.post("http://localhost:8000/api/projection/create", this.newProjection);

      console.log(response.data);

      this.$router.push("/films/list");
    }
  },
  computed: {
    isFormValid() {
      let formIsValid = true;

      this.formFields.forEach(field => {
        if (field.required) {
          formIsValid = formIsValid && !!this.newProjection[field.code];
        }
      });

      return formIsValid;
    }
  }
};
</script>
