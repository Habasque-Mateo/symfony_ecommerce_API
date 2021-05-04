<template>
  <div id="app">
    <img alt="Vue logo" src="./assets/logo_cadis.png" class="logo">
    <div class="app-title">
      <h1>E-COMMERCE</h1>
    </div>
    <Header></Header>
    <div class="container">
          <router-view></router-view>
    </div>
  </div>
</template>



<script>
//import Login from './components/LogIn.vue'
import Header from './components/Header.vue'

export default {
  name: 'App',
  components: {
    Header
  }
}
</script>

 

<style lang="scss">
  
  @font-face {
    font-family: neon;
    src: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/707108/neon.ttf);
  }

  body {

    background-color: #212b38;
  }

  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 20px;
  }

  .logo {
    height: 50px;
    padding-bottom: 10px;
  }

  .app-title {
    font-family: neon;
    color: #1fcfc6;
    font-size: 30px;
    line-height: 20%;
    text-shadow: 0 0 30px #1fcfc6;
    padding-bottom: 20px;
  }
  

</style>
