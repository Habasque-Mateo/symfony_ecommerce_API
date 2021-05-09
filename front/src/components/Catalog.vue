<template>
  <div>
        <h1>Catalog</h1>
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
            <label for="description" class="input-title">Description :</label>
            <br>
            <input class="form-control mr-sm-2 dark-input-color"  type="text" id="description" name="description" v-model="form.decription">
            <br>
            <br>
            <label for="photo" class="input-title">Photo :</label>
            <br>
            <input class="form-control mr-sm-2 dark-input-color"  type="text" id="photo" name="photo" v-model="form.photo">
            <br>
            <br>
            <label for="price" class="input-title">Price :</label>
            <br>
            <input class="form-control mr-sm-2 dark-input-color"  type="text" id="price" name="price" v-model="form.price">
            <br>
            <br>
            <button class="btn btn-primary submit-theme-button">Submit</button>
          </form>
        </modal>
        <table>
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Description</th>
              <th>Photo</th>
              <th>Price</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in {catalog}" :key="product.id">
              <td>{{product.id}}</td>
              <td>{{product.name}}</td>
              <td>{{product.description}}</td>
              <td>{{product.image}}</td>
              <td>{{product.price}}</td>
              <td><a @click="showModal = true"><img alt="edit" src="@/assets/edit.png" class="edit-button"></a></td>
              <td><a v-on:click="deleteRaw(product.id)"><img alt="delete" src="@/assets/delete.png" class="delete-button"></a></td>
            </tr>
          </tbody>
        </table>
    </div>
</template>

<script>

  import axios from 'axios';
  export default {
    name: 'catalog',
    data (){
      return {
        showModal: false,
        form : {
            name: '',
            description: '',
            photo: '',
            price: ''
        },
        catalog: {

        }
      }
    },
    mounted() {
      axios
        .get('https://10.0.2.15/api/products')
        .then((response) => {
          this.catalog = response.data,
          console.warn("get products :", this.catalog)
        })
        .catch(error => console.log(error))
	alert(info)
    },
    methods: {
      edit: function () {

      },
      deleteRaw: function (productId) {
       /* axios
          .delete('https://10.0.2.15/api/' + { productId })
          .then(response => (this.info = response.data))
          .catch(error => console.log(error))*/
        alert('raw deleted')
      },
      submitForm: function () {
        alert(this.form)
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
