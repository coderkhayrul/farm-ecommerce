@extends('layouts.appadmin')

@section('title')
Add Category
@endsection

@section('content')
<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Category</h4>
                {!! Form::open(['route' =>'category.store', 'class' => 'cmxform', 'method' => 'post', 'id' =>
                'commentForm']) !!}
                @csrf
                <div class="form-group">
                    {{ Form::label('', 'Product Category', ['for' => 'cname']) }}
                    {{ Form::text('category_name', '', ['class' => 'form-control', 'minlength' => '2']) }}
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
