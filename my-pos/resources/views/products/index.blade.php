@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="float-start">ADD PRODUCTS</h5>
                    <a class="float-end" data-bs-toggle="modal" data-bs-target="#addProduct" href="#">
                        <i class="fa fa-plus"></i> Add New Product
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Brand</th>
                                <th>Selling Price</th>
                                <th>Qty</th>
                                <th>Alert Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if ($product->quantity <= $product->quantity)
                                        <span class="badge badge-danger"> Low Stock >{{ $product->alert_stock }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $product->alert_stock }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editProduct{{ $product->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProduct{{ $product->id }}">
                                            <i class="fa fa-trash"></i> Del
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Delete Product Modal for each product -->
                            <div class="modal fade right" id="deleteProduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteProductLabel{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteProductLabel{{ $product->id }}">Delete Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete <strong>{{ $product->product_name }}</strong>?</p>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Delete Product Modal -->

                            <!-- Edit Product Modal for each product -->
                            <div class="modal right fade" id="editProduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mb-3">
                                                    <label for="product_name">Product Name</label>
                                                    <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="brand">Brand</label>
                                                    <input type="text" name="brand" value="{{ $product->brand }}" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="price">Selling Price</label>
                                                    <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="form-control" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="alert_stock">Alert Stock</label>
                                                    <input type="number" name="alert_stock" value="{{ $product->alert_stock }}" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="" cols="30" rows="2" class="form-control">{{ $product->description }}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-warning btn-block">Update Product</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Edit Product Modal -->

                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Search Product</h5>
                </div>
                <div class="card-body">
                    <!-- Search functionality could go here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade right" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Selling Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alert_stock">Alert Stock</label>
                        <input type="number" name="alert_stock" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Add Product Modal -->

<!-- Custom Modal Styling -->
<style>
    .modal.right .modal-dialog {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        min-width: 300px;
    }
</style>
@endsection
