@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Role permission data') }}</div>

                <div class="card-body">
                    <!-- <button type="button" id="new_item_btn" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addItemModal">New Item</button> -->
                    <table id="rolePermissionTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Role name</th>
                                <th>Privileges</th>
                                <th class="action_btns">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roles as $role) { ?>
                            <tr>
                                <td>{{$role->role_name}}</td>
                                <td>
                                    <?php foreach ($permission as $key => $per) {?>
                                        <div class="perm">
                                            <input class="perm_check" name="checkbox_{{ $key }}" type="checkbox" id="checkbox_{{ $key }}" value="{{ $per->id }}">
                                            <label class="perm_label" for="checkbox_{{ $key }}">{{ $per->permission_name }}</label>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-id="" id="edit_perm_btn">Edit</button> 
                                    <button class="btn btn-danger" type="button" data-id="" id="delete_perm_btn">Delete</button>
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
    <div class="modal fade" id="rolesPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="role_permission_id" id="role_permission_id_val" value="">
                    <h5 class="modal-title" id="modalRolePermHeader">Add new item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_role_perm_form">
                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Name') }}</label>
        
                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
        
                            <label for="description" class="col-md-2 col-form-label text-md-end">{{ __('Description') }}</label>
        
                            <div class="col-md-4">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" id="save_role_permission" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
