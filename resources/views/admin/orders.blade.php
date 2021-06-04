@extends('layouts.appadmin')
@section('title')
    Orders
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Orders</h4>
        {{-- @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif --}}
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Client Name</th>
                                <th>Address</th>
                                <th>Cart</th>
                                <th>Payment Id</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ Form::hidden('', $increment = 1) }}
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $increment }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->address }}</td>
                                <td>
                                    Fixing
                                </td>

                                <td>{{ $order->payment_id }}</td>
                                <td>
                                    <button class="btn btn-outline-primary" onclick="window.location = '{{ url('view_pdf/'.$order->id) }}'">View</button>
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
