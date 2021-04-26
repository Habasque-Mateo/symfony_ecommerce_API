<template>
  <div>
        <h1>Catalog</h1>
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
            <tr v-for="product in info" :key="product.id">
              <td>{{product.id}}</td>
              <td>{{product.name}}</td>
              <td>{{product.description}}</td>
              <td>{{product.image}}</td>
              <td>{{product.price}}</td>
              <td><a><img alt="edit" src="@/assets/edit.png" class="edit-button"></a></td>
              <td><a><img alt="delete" src="@/assets/delete.png" class="delete-button"></a></td>
            </tr>
          </tbody>
        </table>
    </div>
</template>

<script>

  import axios from 'axios';

  export default {
    name: 'catalog',
    mounted() {
      axios
        .get('https://localhost:8000/api/product')
        .then(response => (this.info = response.data))
        .catch(error => console.log(error))
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

</style>