@extends('layouts.app')

@section('content')
<div class="login-box animated fadeInDown">
    <div class="login-logo"></div>
    <div class="login-body">
        <div class="login-title"><strong>Log In</strong> to your account</div>
        <form action="{{ route('login') }}" class="form-horizontal" method="post">
            @csrf
            <div class="form-group">
                <div class="col-md-12">
                    <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" placeholder="Username" required autofocus/>

                    @if ($errors->has('user_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required/>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">          
                <div class="col-md-6 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <span class="form-check-label" for="remember" style="color: white">
                        Remember me
                    </span>
                </div>
                <div class="col-md-6">
                    <a href="" class="btn btn-link btn-block">Forgot your password?</a>
                </div>
                
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-info btn-block">Log In</button>
                </div>
            </div>
            <div class="login-or">OR</div>
            <div class="form-group">
                <div class="col-md-4">
                    <button class="btn btn-info btn-block btn-twitter"><span class="fa fa-twitter"></span> Twitter</button>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-info btn-block btn-facebook"><span class="fa fa-facebook"></span> Facebook</button>
                </div>
                <div class="col-md-4">                            
                    <button class="btn btn-info btn-block btn-google"><span class="fa fa-google-plus"></span> Google</button>
                </div>
            </div>
            <div class="login-subtitle">
                Don't have an account yet? <a href="{{route('register')}}">Create an account</a>
            </div>
        </form>
    </div>
    <div class="login-footer">
        <div class="pull-left">
            &copy; 2019 AnhQuan
        </div>
    </div>
</div>
@endsection
