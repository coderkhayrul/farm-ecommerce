@extends('layouts.appadmin')
@section('title')
    Products
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Products</h4>
        <!-- Get Session Status  Start-->
        @if (Session::has('status') )
        <div class="alert alert-success text-white">
            {{ Session::get('status') }}
        </div>
        @endif
        @if (Session::has('status1') )
        <div class="alert alert-danger text-white">
            {{ Session::get('status1') }}
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
                                <th>Image</th>
                                <th>Description One</th>
                                <th>Description One</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ Form::hidden('', $increment = 1) }}
                            @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $increment }}</td>
                                <td><img src="/storage/slider_image/{{ $slider->slider_image}}" alt=""></td>
                                <td>{{ $slider->description1 }}</td>
                                <td>${{ $slider->description2 }}</td>
                                <td>
                                    @if ($slider->status === 1)
                                    <label class="badge badge-success">Activated</label>
                                    @else
                                    <label class="badge badge-danger">Unactivated</label>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary" onclick="window.location = '{{ url('/editslider/'.$slider->id) }}'">Edit</button>
                                    <a href="{{ route('slider.delete',$slider->id) }}" class="btn btn-outline-danger" id="delete">Delete</a>
                                    @if ($slider->status === 1)
                                        <button class="btn btn-outline-warning" onclick="window.location = '{{ url('/unactivated_slider/'.$slider->id) }}'">Unactivated</button>
                                    @else
                                        <button class="btn btn-outline-success" onclick="window.location = '{{ url('/activated_slider/'.$slider->id) }}'">Activated</button>
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
