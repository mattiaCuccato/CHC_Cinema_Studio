<template>
  <div class="flex max-w-screen-md mx-auto py-5">
    <div
      v-for="link in navLinks"
      :key="link.code"
      :class="{
        'text-decoration: underline p-2': link.code == currentRouteName,
      }"
      @click="goToLink(link)"
      class="mr-8 cursor-pointer px-3 py-1 rounded-full"
    >
      {{ link.label }}
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      navLinks: [
        {
          label: "Home",
          code: "films_list"
        },
        {
          label: "Inserisci film",
          code: "films_create"
        },
        {
          label: "Inserisci proiezione",
          code: "projections_create"
        }

      ]
    };
  },
  computed: {
    currentRouteName() {
      return this.$route.matched[0].name;
    }
  },
  methods: {
    goToLink(link) {
      this.$router.push({
        name: link.code
      });
    }
  }
};
</script>
