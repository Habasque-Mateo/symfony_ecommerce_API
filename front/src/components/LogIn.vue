<template>
  <div>
    <h1>LogIn</h1>
    <form class="field-set" method="POST" v-on:submit.prevent="submitForm">
        <button class="close" @click="showModal = false">
          <span aria-hidden="true">&times;</span>
        </button>
        <label for="email" class="input-title">Email :</label>
        <br>
        <input class="form-control mr-sm-2 dark-input-color"  type="text" id="email" name="email" v-model="form.email">
        <br>
        <br>
        <label for="password" class="input-title">Password :</label>
        <br>
        <input class="form-control mr-sm-2 dark-input-color"  type="text" id="password" name="password" v-model="form.password">
        <br>
        <br>
        <button class="btn btn-primary submit-theme-button">Submit</button>
      </form>
    </div>
</template>

<script>
//import axios from 'axios';

export default {
    name: 'user',
    data (){
      return {
        form : {
          email: '',
          password: ''
        }
      }
    },
    methods: {
      submitForm: function () {
        alert(this.form)
      }
    }
}

</script>

<style scoped>

  form {
    width: 450px;
    min-height: 500px;
    height: auto;
    border-radius: 5px;
    margin: 2% auto;
    box-shadow: 0 9px 50px hsla(20, 67%, 75%, 0.31);
    padding: 2%;
    background-image: linear-gradient(-225deg, #212b37 50%, #3b3b3b 50%);
    box-shadow:  0 0 30px black;
  }

  .input-title{
    color: white;
  }

  .dark-input-color {
      background-color: black;
      color: lightgray;
      border-color: #1fcfc6;
  }

  .submit-theme-button {
    background-color: rgb(71, 71, 71);
    color: lightgray;
    border-color: #1fcfc6;
  }

</style>