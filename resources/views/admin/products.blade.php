@extends('layouts.appadmin')
@section('title')
    Products
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Products</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ Form::hidden('', $increment = 1) }}
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $increment }}</td>
                                <td><img src="/storage/product_image/{{ $product->product_image}}" alt=""></td>
                                <td>{{ $product->product_name }}</td>
                                <td>${{ $product->product_price }}</td>
                                <td>{{ $product->product_category }}</td>
                                <td>
                                    @if ($product->status === 1)
                                    <label class="badge badge-success">Activated</label>
                                    @else
                                    <label class="badge badge-danger">Unactivated</label>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary">Edit</button>
                                    <a href="" class="btn btn-outline-danger" id="delete">Delete</a>
                                    @if ($product->status === 1)
                                        <button class="btn btn-outline-warning">Unactivated</button>
                                    @else
                                        <button class="btn btn-outline-success">Activated</button>
                                    @endif
                                </td>
                            </tr>
                            {{ Form::hidden('', $increment = $increment + 1) }}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- Custom js for this page-->
    <script src="{{ asset('backend') }}/js/data-table.js"></script>
@endsection
