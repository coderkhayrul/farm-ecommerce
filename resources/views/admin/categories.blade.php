@extends('layouts.appadmin')
@section('title')
    Categories
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Categories</h4>
        <!-- Get Session Status  Start-->
        @if (Session::has('status') )
        <div class="alert alert-success text-white">
            {{ Session::get('status') }}
        </div>
        @endif
        <!-- Get Session Status End -->
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ Form::hidden('', $increment = 1) }}
                            @foreach ($categories as $category )
                                <tr>
                                    <td>{{ $increment }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <button class="btn btn-outline-primary" onclick="window.location = '{{ url('/edit_category/'.$category->id) }}'">Edit</button>
                                        <a id="delete" class="btn btn-outline-danger" href="{{ URL::to('/delete_category/'.$category->id) }}">Delete</a>
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
