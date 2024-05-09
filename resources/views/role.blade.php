@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Roles Data') }}</div>
                    <div class="card-body">
                        <button type="button" id="new_item_btn" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#roleItemModal">Add role</button>
                        <table id="roleTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th class="action_btns">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roles as $role) { ?>
                                    <tr>
                                        <td>{{ $role->role_name }}</td>
                                        <td>
                                            <button class="btn btn-primary" type="button" data-id="{{$role->id}}" id="edit_role_btn">Edit</button> 
                                            <button class="btn btn-danger" type="button" data-id="{{$role->id}}" id="delete_role_btn">Delete</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="roleItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="role_id" id="role_id_val" value="">
                    <h5 class="modal-title" id="modalRoleHeader">Add new role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_role_form">
                        <div class="row mb-3">
                            <label for="role_name" class="col-md-4 col-form-label text-md-end">{{ __('Role Name') }}</label>
        
                            <div class="col-md-6">
                                <input id="role_name" type="text" class="form-control @error('role_name') is-invalid @enderror" name="role_name" value="{{ old('role_name') }}" required autocomplete="role_name" autofocus>
                                @error('role_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="save_role_item" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
