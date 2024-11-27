@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left">ADD USER</h5>
                        <a style="float: right" data-bs-toggle="modal" data-bs-target="#addUser" href="">
                            <i class="fa fa-plus"></i> Add New User
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->is_admin == 1) Admin @else Cashier @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Edit Button -->
                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{ $user->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <!-- Delete Button -->
                                            <a href="{{ route('users.destroy', ['user' => $user->id]) }}" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Del
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit User Modal -->
                                <div class="modal right fade" id="editUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Phone</label>
                                                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" name="password" readonly value="{{ $user->password }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Role</label>
                                                        <select name="is_admin" class="form-control">
                                                            <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                                                            <option value="2" {{ $user->is_admin == 2 ? 'selected' : '' }}>Cashier</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-block">Update User</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit User Modal -->

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Search User</h5>
                    </div>
                    <div class="card-body">
                        <!-- Search functionality could go here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="is_admin" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Cashier</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal right fade" id="deleteUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteUserLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserLabel{{ $user->id }}">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>
                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Delete User Modal -->

<!-- Custom Modal Styling -->
<style>
    .modal.right .modal-dialog {
        top: 0;
        right: 0;
        margin-right: 20vh;
    }
    .modal.fade:not(.in).right .modal-dialog {
        transform: translate3d(25%, 0, 0);
    }
</style>
@endsection
