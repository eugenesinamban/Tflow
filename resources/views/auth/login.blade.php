@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address or Username') }}</label>

                    <div class="col-md-6">
                        <input id="login" type="text" class="form-control @if($errors->has('email') || $errors->has('username')) is-invalid @endif" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>
                        @if($errors->has('email') || $errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first() }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        {{ __('Left but wants to come back?') }}
                        <a href="/reactivate" class="btn btn-link">
                            {{ __('Reactivate Your Account') }}
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Test Account Details
        </div>
        <div class="card-body">
            <h4 class="card-title">
                Username : test
            </h4>
            <h4 class="card-title">
                email : test@test.com
            </h4>
            <h6 class="card-substitle">
                password : testtest
            </h6>
        </div>
    </div>
@endsection
