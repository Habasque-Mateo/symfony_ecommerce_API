<template>
  <div>
        <h1>User</h1>
        <modal v-if="showModal" @close="showModal = false">
          <form class="field-set" method="POST" v-on:submit.prevent="submitForm">
            <button class="close" @click="showModal = false">
              <span aria-hidden="true">&times;</span>
            </button>
            <label for="name" class="input-title">Name :</label>
            <br>
            <input class="form-control mr-sm-2 dark-input-color"  type="text"  id="name" name="name" v-model="form.name">
            <br>
            <br>
            <label for="password" class="input-title">Password :</label>
            <br>
            <input class="form-control mr-sm-2 dark-input-color"  type="text" id="password" name="password" v-model="form.password">
            <br>
            <br>
            <label for="email" class="input-title">Email :</label>
            <br>
            <input class="form-control mr-sm-2 dark-input-color"  type="text" id="email" name="email" v-model="form.email">
            <br>
            <br>
            <label for="lastname" class="input-title">Lastname :</label>
            <br>
            <input class="form-control mr-sm-2 dark-input-color"  type="text" id="lastname" name="lastname" v-model="form.lastname">
            <br>
            <br>
            <button class="btn btn-primary submit-theme-button">Submit</button>
          </form>
        </modal>
        <table>
          <thead>
            <tr>
              <th>Login</th>
              <th>Password</th>
              <th>Email</th>
              <th>Lastname</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>PE_leSage</td>
              <td>P@ssw0rq</td>
              <td>Pierre@gmail.com</td>
              <td>coq</td>
              <td><a @click="showModal = true"><img alt="edit" src="@/assets/edit.png" class="edit-button"></a></td>
              <td><a v-on:click="deleteRaw"><img alt="delete" src="@/assets/delete.png" class="delete-button"></a></td>
            </tr>
            <tr>
              <td>Mat_leGrand</td>
              <td>P@ssw0rq</td>
              <td>Mat@gmail.com</td>
              <td>Habasque</td>
              <td><a @click="showModal = true"><img alt="edit" src="@/assets/edit.png" class="edit-button"></a></td>
              <td><a v-on:click="deleteRaw"><img alt="delete" src="@/assets/delete.png" class="delete-button"></a></td>
            </tr>
          </tbody>
        </table>
    </div>
</template>

<script>

//import axios from 'axios';

export default {
    name: 'user',
    data (){
      return {
        showModal: false,
        form : {
          name: '',
          password: '',
          email: '',
          lastname: ''
        },
        user : { 

        }
      }
    },
    methods: {
      edit: function () {

      },
      deleteRaw: function () {
       /* axios
          .delete('https://10.0.2.15/api/' + { user.id })
          .then(response => (this.info = response.data))
          .catch(error => console.log(error))*/
        alert('raw deleted')
      },
      submitForm: function () {
        axios
          .post("http://10.0.2.15/api/login", this.form)
          .then(response => this.user = response.data)

        alert(this.user)
      }
    }
}

</script>


<style scoped>

  table {
    height: 80%;
    width: 80%;
    display: relative;
    text-align: center;
    border-radius: 3px;
    border: 1px solid lightgray;
    background-color: #343a40;
    color: white;
  }

  thead {
      border: 1px solid lightgray;
  }

  tbody {
    color : grey;
  }

  tr {
    margin-bottom: 50px;
  }

  .edit-button {
    height: 20px;
  }

  .delete-button {
    height: 25px;
  }

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