
@extends('app')
@section('content')
  <div class="form-group row add">
    <div class="col-md-12">
      <h1>Simple Laravel Vue.Js Crud</h1>
    </div>
    <div class="col-md-12">
      <button type="button" data-toggle="modal" data-target="#create-item" class="btn btn-primary">
        Create New User
      </button>
    </div>
  </div>
  <div class="row">
    <div class="table-responsive">
      <table class="table table-borderless">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
        <tr v-for="item in items">
          <td>@{{ item.name }}</td>
          <td>@{{ item.email }}</td>
          <td>
            <button class="edit-modal btn btn-warning" @click.prevent="editItem(item)">
              <span class="glyphicon glyphicon-edit"></span> Edit
            </button>
            <button class="edit-modal btn btn-danger" @click.prevent="deleteItem(item)">
              <span class="glyphicon glyphicon-trash"></span> Delete
            </button>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <nav>
    <ul class="pagination">
      <li v-if="pagination.current_page > 1">
        <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
          <span aria-hidden="true">«</span>
        </a>
      </li>
      <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
        <a href="#" @click.prevent="changePage(page)">
          @{{ page }}
        </a>
      </li>
      <li v-if="pagination.current_page < pagination.last_page">
        <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
          <span aria-hidden="true">»</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- Create Item Modal -->
  <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Create New User</h4>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createItem">
            <div class="form-group">
              <label for="title">Name:</label>
              <input type="text" name="name" class="form-control" v-model="newItem.name" />
              <span v-if="formErrors['name']" class="error text-danger">
                @{{ formErrors['name'] }}
              </span>
            </div>
            <div class="form-group">
              <label for="title">Email:</label>
              <input name="email" class="form-control" v-model="newItem.email" />
              <span v-if="formErrors['email']" class="error text-danger">
                @{{ formErrors['email'] }}
              </span>
            </div>

            <div class="form-group">
              <label for="title">Password:</label>
              <input name="password" class="form-control" v-model="newItem.password" />
              <span v-if="formErrors['password']" class="error text-danger">
                @{{ formErrors['password'] }}
              </span>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- Edit Item Modal -->
<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit User</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
          <div class="form-group">
            <label for="title">Name:</label>
            <input type="text" name="name" class="form-control" v-model="fillItem.name" />
            <span v-if="formErrorsUpdate['name']" class="error text-danger">
              @{{ formErrorsUpdate['name'] }}
            </span>
          </div>
          <div class="form-group">
            <label for="title">Email:</label>
            <input name="email" class="form-control" v-model="fillItem.email" />
            <span v-if="formErrorsUpdate['email']" class="error text-danger">
              @{{ formErrorsUpdate['email'] }}
            </span>
          </div>


          <div class="form-group">
            <label for="title">Password:</label>
            <input name="password" class="form-control" v-model="fillItem.password" />
            <span v-if="formErrorsUpdate['password']" class="error text-danger">
              @{{ formErrorsUpdate['password'] }}
            </span>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
