@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Permission Data') }}</div>

                <div class="card-body">
                    <button type="button" id="new_item_btn" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#permissionModal">New Item</button>
                    <table id="permissionTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Permission Name</th>
                                <th class="action_btns">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($permissions as $permission) { ?>
                                <tr>
                                    <td>{{ $permission->permission_name }}</td>
                                    <td>
                                        <button class="btn btn-primary" type="button" data-id="{{$permission->id}}" id="edit_perm_btn">Edit</button> 
                                        <button class="btn btn-danger" type="button" data-id="{{$permission->id}}" id="delete_perm_btn">Delete</button>
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
    <div class="modal fade" id="permissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="permission_id" id="permission_id_val" value="">
                    <h5 class="modal-title" id="modalPermHeader">Add new item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_permission_form">
                        <div class="row mb-3">
                            <label for="permission_name" class="col-md-4 col-form-label text-md-end">{{ __('Permission name') }}</label>
                            <div class="col-md-6">
                                <input id="permission_name" type="text" class="form-control @error('permission_name') is-invalid @enderror" name="permission_name" value="{{ old('permission_name') }}" required autocomplete="permission_name" autofocus>
                                @error('permission_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="save_permission" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
