@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Inventory Data') }}</div>

                <div class="card-body">
                    <input id="file-import" type="file" style="display:none;">
                    <!-- <input id="excel-import" type="file" style="display:none;"> -->
                    <button type="button" id="new_item_btn" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addItemModal">New Item</button>
                    <table id="inventoryTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Quantity in stock</th>
                                <th>Price</th>
                                <th class="action_btns">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->quantity_in_stock }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <button class="btn btn-primary" type="button" data-id="{{$product->id}}" id="edit_btn">Edit</button> 
                                        <button class="btn btn-danger" type="button" data-id="{{$product->id}}" id="delete_btn">Delete</button>
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
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="product_id" id="product_id_val" value="">
                    <h5 class="modal-title" id="modalHeader">Add new item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_item_form">
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
                        <div class="row mb-3">
                            <label for="quantity_in_stock" class="col-md-2 col-form-label text-md-end">{{ __('Quantity in stock') }}</label>
        
                            <div class="col-md-4">
                                <input id="quantity_in_stock" type="number" min="0" class="form-control @error('quantity_in_stock') is-invalid @enderror" name="quantity_in_stock" value="{{ old('quantity_in_stock') }}" required autocomplete="quantity_in_stock" autofocus>
                                @error('quantity_in_stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
        
                            <label for="price" class="col-md-2 col-form-label text-md-end">{{ __('Price') }}</label>
        
                            <div class="col-md-4">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="save_item" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
