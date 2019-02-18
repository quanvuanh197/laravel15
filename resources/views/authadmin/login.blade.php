@extends('layouts.app')

@section('content')
<div class="login-box animated fadeInDown">
    <div class="login-body">
        <div class="login-title"><strong>Log In</strong> to your account</div>
        <form action="{{ route('admin.login') }}" class="form-horizontal" method="post">
            @csrf
            <div class="form-group">
                <div class="col-md-12">
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('username') }}" placeholder="Username" required autofocus/>

                    @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
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
                
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-info btn-block">Log In</button>
                </div>
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
