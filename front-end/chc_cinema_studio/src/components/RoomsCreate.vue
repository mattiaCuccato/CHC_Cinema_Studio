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
                v-model="newRoom[field.code]"
              />
            </div>
            <div v-if="field.type == 'checkbox'">
              <input
                :id="field.code"
                class="p-2 px-3 rounded focus:outline-none"
                type="checkbox"
                v-model="newRoom[field.code]"
              />
            </div>
            <div v-if="field.type == 'textarea'">
              <textarea
                v-model="newRoom[field.code]"
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
                v-model="newRoom[field.code]"
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
                v-model="newRoom[field.code]"
              />
            </div>
          </div>
          <div
            class="flex items-center px-3 text-red-600"
            v-if="field.required"
          >
            <span v-if="!newRoom[field.code]">
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
        @click="saveRoom()"
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
      isEdit: false,
      newRoom: {
          /* DA CONFERMARE */ 
          name = "",
          rows = 0,
          cols = 0,
          max_seats = 0,
      },
      formFields: [
        {
          code: "name",
          label: "Nome sala",
          type: "text",
          placeholder:"Inserisci il nome della sala",
          required: true,
        },
        {
          code: "rows",
          label: "Nome sala",
          type: "text",
          placeholder:"Inserisci il nome della sala",
          required: true,
        },
        {
          code: "cols",
          label: "Numero colonne",
          type: "number",
          placeholder:"Inserisci il numero di colonne",
          required: true,
        },
                {
          code: "max_seats",
          label: "Numero posti",
          type: "number",
          placeholder:"Inserisci il numero di posti",
          required: true,
        },
      ]
    };
  },
  async mounted() {
    if (this.$route.name == "rooms_edit") {
      this.isEdit = true;
      let roomId = this.$route.params.id;
      let response = await axios.get("http://localhost:3000/rooms/" + roomId);

      this.newRoom = response.data;
      console.log(this.newRoom);
    }
  },
  methods: {
    async saveRoom() {
      let response;

      if (this.isEdit) {
        response = await axios.put(
          "http://localhost:3000/rooms/" + this.$route.params.id,
          this.newRoom
        );
      } else {
        response = await axios.post("http://localhost:3000/rooms", this.newRoom);
      }

      console.log(response.data);

      this.$router.push("/rooms/list");
    }
  },
  computed: {
    isFormValid() {
      let formIsValid = true;

      this.formFields.forEach(field => {
        if (field.required) {
          formIsValid = formIsValid && !!this.newRoom[field.code];
        }
      });

      return formIsValid;
    }
  }
};
</script>
