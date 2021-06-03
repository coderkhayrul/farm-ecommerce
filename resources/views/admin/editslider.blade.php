@extends('layouts.appadmin')

@section('title')
Edit Slider
@endsection

@section('content')
<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Slider</h4>
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
                {!! Form::open(['route' =>['slider.update',$slider->id], 'class' => 'cmxform', 'method' => 'post', 'id'
                => 'commentForm','enctype' => 'multipart/form-data']) !!}
                @csrf
                @method('PUT')
                {{ Form::hidden('id', $slider->id) }}
                <div class="form-group">
                    {{ Form::label('', 'Description One', ['for' => 'slide_name']) }}
                    {{ Form::text('description_one', $slider->description1, ['class' => 'form-control', 'minlenght' => '2']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('', 'Description Two', ['for' => 'slider_price']) }}
                    {{ Form::text('description_two', $slider->description2, ['class' => 'form-control', 'minlenght' => '2']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('', 'slider Image', ['for' => 'slider_image']) }}
                    {{ Form::file('slider_image', ['class' => 'form-control']) }}
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
