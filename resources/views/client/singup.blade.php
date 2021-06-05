@extends('layouts.loginApp')

@section('title')
Registation
@endsection

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
            <!-- Get Session Status  Start-->
            @if (Session::has('status') )
            <div class="alert alert-success text-white">
                {{ Session::get('status') }}
            </div>
            @endif
            @if (count($errors) > 0 )
            <div class="alert alert-danger text-white">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Get Session Status End -->
            <form action="{{ route('client.createaccount') }}" class="login100-form validate-form" method="POST">
                @csrf
                <a href="{{ URL::to('/') }}">
                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-landscape"></i>
                    </span>
                </a>

                <span class="login100-form-title p-b-34 p-t-27">
                    Registation
                </span>
                <div class="wrap-input100 validate-input" data-validate = "Enter Email">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Singup
                    </button>
                </div>
                <div class="text-center p-t-90">
                    <a class="txt1" href="/login">
                        Do you have an account ? Singin
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
