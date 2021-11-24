<template>
  <div class="w-full min-h-screen max-w-screen-md mx-auto flex flex-col">
    <div class="flex">
      <div class="flex flex-col mt-10"  @click="goBack()">
        <button class="bg-white text-black rounded px-3 py-1">
          Indietro
        </button>
      </div>
    </div>
    <div class="flex justify-center m-5 px-12 items-center">
      <div class="flex flex-col font-bold pr-5 text-3xl">
        <span>{{ projection.film.title }} </span>
      </div>
    </div>
    <div class="flex justify-center mb-10 px-12 items-center">
      <div class="flex flex-col pr-5">
        {{ projection.date }}
      </div>
    </div>

    <div class="flex justify-between">
      <div class="flex flex-col">
        <label>Nome</label>
        <input
          type="text"
          v-model="newReservation.name_user"
          placeholder="inserisci nome"
          class="text-black px-2 py-2 rounded mt-2"
          required
        />
      </div>
      <div class="flex flex-col">
        <label>Cognome</label>
        <input
          type="text"
          v-model="newReservation.surname_user"
          placeholder="inserisci cognome"
          class="text-black px-2 py-2 rounded mt-2"
          required
        />
      </div>
      <div class="flex flex-col">
        <label>email</label>
        <input
          type="text"
          v-model="newReservation.email"
          placeholder="inserisci email"
          class="text-black px-2 py-2 rounded mt-2"
          required
        />
      </div>
    </div>

    <div class="flex flex-col items-center mt-12" v-if="projection">
      <div
        v-for="(row, indexR) in projection.room.rows"
        :key="indexR"
        class="flex"
      >
        <div
          v-for="(col, indexC) in projection.room.cols"
          :key="indexC"
          class="flex p-2 flex-col"
        >
          <div v-if="seatIsAlreadyOccupied(row, col)" class="bg-red-400 px-2">
            O
          </div>
          <button
            v-else
            @click="selectSeat(row, col)"
            :id="indexC + 1 + '' + (indexR + 1)"
            :class="getSeatClass(row, col)"
          >
            O
          </button>
        </div>
      </div>
      <div class="mt-10 text-xl">
        <span>Posti Selezionati: </span>
        <span v-for="seat in newReservation.tickets" :key="seat" class="text-xl bold">
          {{ seat.code }}.
        </span>
      </div>
    </div>
    <div class="flex justify-center">
    <button class="px-3 py-1 rounded bg-red-600 w-3/12 cursor-pointer my-10" @click="saveReservation()">
      Prenota
    </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      ticketsCodes: [],
      occupiedCodes: [],
      projection: null,
      newReservation: {
        projection_id: 0,
        name_user: "",
        surname_user: "",
        email: "",
        tickets: [],
      },
    };
  },
  async mounted() {
    let projectionId = this.$route.params.id;

    let responseProjection = await axios.get(
      "http://localhost:8000/api/projection/" + projectionId
    );

    this.projection = responseProjection.data;
    console.log(this.projection.tickets);
    /*
        let responseOccupiedCodes = await axios.get(
      "http://localhost:3001/codes"
    );

        this.occupiedCodes =responseOccupiedCodes.data;

    for(let iR = 0 ;(this.projection.room.rows); iR++){
      for(let iC = 0; (this.projection.room.cols); iC++){
        let id = (iC+1 )+ '' + (iR+1);
        if (this.occupiedCodes.includes(id)){
          let button = document.getElementById(id)
          button.className = "btn-occupied";
        }
      }
    }
    */
  },
  methods: {
    seatIsAlreadyOccupied(row, col) {
      let foundTicket = this.projection.tickets.findIndex((ticket) => {
        return ticket.row == row && ticket.col == col;
      });

      return foundTicket > -1;
    },
    getSeatClass(row, col) {
      let foundTicket = this.newReservation.tickets.findIndex((ticket) => {
        return ticket.row == row && ticket.col == col;
      });

      if (foundTicket == -1) {
        // If not => green-400
        return "bg-green-400 px-2";
      } else {
        // If seat is selected => red-400
        return "bg-yellow-400 px-2";
      }
    },
    async saveReservation() {
      let projectionId = this.$route.params.id;
      let responseReservation;
      this.newReservation.projection_id = projectionId;
      responseReservation = await axios.post(
        "http://localhost:8000/api/reservation/create",
        this.newReservation
      );

      console.log(responseReservation.data);

      this.$router.push("/films/list");
    },
    selectSeat(row, col) {
      var letters = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"]

      let rowLetter = letters[(row-1)]
      let code = rowLetter + "" + col;

      // Check if seat is alteady selected
      let foundTicket = this.newReservation.tickets.findIndex((ticket) => {
        return ticket.row == row && ticket.col == col;
      });

      // If not selected, select it
      if (foundTicket == -1) {
        // Select a seat = push item to array
        this.newReservation.tickets.push({
          row: row,
          col: col,
          code: code,
        });
      } else {
        // If selected, then de select it
        this.newReservation.tickets.splice(foundTicket, 1);
      }
    },
    goBack(){
      this.$router.back();
    }

  },
};
</script>

<style>
.btn {
  border-style: solid;
  border-width: 2px;
}
.btn-selected {
  font-weight: bold;
  color: red;
}
.btn-occupied {
  font-weight: bold;
  color: grey;
}
</style>