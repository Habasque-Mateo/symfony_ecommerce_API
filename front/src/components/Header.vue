<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarColor02">      
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <router-link class="nav-link nav-bar-item" to="/">Home
                        <span class="sr-only">(current)</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link nav-bar-item" to="/user">User</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link nav-bar-item" to="/catalog">Catalog</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link nav-bar-item" to="/order">Order</router-link>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2 dark-search-bar-color" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</template>

<script>
    //import router from "@/router.js";
    export default {
        name: 'header'
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

   .nav-bar-item:hover {
     color: #1fcfc6;
     border-bottom: 2px solid #1fcfc6;
  }

  .dark-search-bar-color {
      background-color: black;
      color: lightgray;
      border-color: #1fcfc6;
  }

</style>
