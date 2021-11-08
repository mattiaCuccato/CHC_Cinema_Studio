<template>
  <div id="app" class="h-screen bg-black text-white">
    <Navigation></Navigation>
    <router-view></router-view>
  </div>
</template>

<script>
import Navigation from "@/components/Navigation.vue";


export default {
  name: 'App',
  components: {
    Navigation
  }
}
</script>


