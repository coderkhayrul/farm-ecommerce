@extends('layouts.loginApp')

@section('title')
Login
@endsection

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
            <!-- Get Session Status  Start-->
            @if (Session::has('error') )
            <div class="alert alert-danger text-white">
                {{ Session::get('error') }}
            </div>
            @endif
            @if (count($errors) > 0 )
            <div class="alert alert-danger text-white">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Get Session Status End -->
            <form action="{{ route('client.accessaccounts') }}" method="POST" class="login100-form validate-form">
                @csrf
                <a href="{{ URL::to('/') }}">
                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-landscape"></i>
                    </span>
                </a>
                <span class="login100-form-title p-b-34 p-t-27">
                    Log in
                </span>

                <div class="wrap-input100 validate-input" data-validate="Enter Email">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-90">
                    <a class="txt1" href="/client_singup">
                        Don,t have an account ? Singup
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
