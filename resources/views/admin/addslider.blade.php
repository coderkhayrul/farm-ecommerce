@extends('layouts.appadmin')

@section('title')
    Add Slider
@endsection

@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Slider</h4>
                    {!! Form::open(['route' =>'category.create', 'class' => 'cmxform', 'method' => 'post', 'id' => 'commentForm']) !!}
                        @csrf
                        <div class="form-group">
                            {{ Form::label('', 'Description One', ['for' => 'description_one']) }}
                            {{ Form::text('description_one', '', ['class' => 'form-control', 'minlenght' => '2']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('', 'Description Two', ['for' => 'description_two']) }}
                            {{ Form::number('description_two', '', ['class' => 'form-control', 'minlenght' => '2']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('', 'Slider Image', ['for' => 'slider_image']) }}
                            {{ Form::file('slider_image', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('', 'Slider Status', ['for' => 'slider_checkbox']) }}
                            {{ Form::checkbox('slider_status', '', 'true', ['class' => 'form-control']) }}
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
