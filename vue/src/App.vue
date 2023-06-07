<template>
  <div id="app">
    <UrlComponent />
  </div>
  <br>
  <div>
    <ListeUrlComponent />
  </div>
</template>

<script>
import UrlComponent from './components/UrlComponent.vue';
import ListeUrlComponent from './components/ListeUrlComponent.vue';
export default {
  name: 'App',
  components: {
    UrlComponent,
    ListeUrlComponent,
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
