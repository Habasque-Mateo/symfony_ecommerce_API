<template>
  <div>
        <h1>User</h1>
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
              <td><a><img alt="edit" src="@/assets/edit.png" class="edit-button"></a></td>
              <td><a><img alt="delete" src="@/assets/delete.png" class="delete-button"></a></td>
            </tr>
            <tr>
              <td>Mat_leGrand</td>
              <td>P@ssw0rq</td>
              <td>Mat@gmail.com</td>
              <td>Habasque</td>
              <td><a><img alt="edit" src="@/assets/edit.png" class="edit-button"></a></td>
              <td><a><img alt="delete" src="@/assets/delete.png" class="delete-button"></a></td>
            </tr>
          </tbody>
        </table>
    </div>
</template>


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