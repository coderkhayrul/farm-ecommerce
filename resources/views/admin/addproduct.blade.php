@extends('layouts.appadmin')

@section('title')
    Add Product
@endsection

@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Product</h4>
                    <!-- Get Session Status Start-->
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
                    {!! Form::open(['route' =>'product.store', 'class' => 'cmxform', 'method' => 'post', 'id' => 'commentForm','enctype' => 'multipart/form-data']) !!}
                        @csrf
                        <div class="form-group">
                            {{ Form::label('', 'Product Name', ['for' => 'product_name']) }}
                            {{ Form::text('product_name', '', ['class' => 'form-control', 'minlenght' => '2']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('', 'Product Price', ['for' => 'product_price']) }}
                            {{ Form::number('product_price', '', ['class' => 'form-control', 'minlenght' => '2']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('', 'Product Category', ['for' => 'product_category']) }}
                            {{ Form::select('product_category', $categories, null, ['placeholder' => 'Select Category' , 'class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('', 'Product Image', ['for' => 'product_image']) }}
                            {{ Form::file('product_image', ['class' => 'form-control']) }}
                        </div>
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Custom js for this page-->
    <script src="{{ asset('backend') }}/js/bt-maxLength.js"></script>
    <!-- End custom js for this page-->
@endsection
