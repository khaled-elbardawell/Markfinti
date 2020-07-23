@extends('layouts.app')

@section('content')


        <div class="card">
            <div class="body">
                <p class="lead">{{ __('Login to your account') }} </p>
                <form class="form-auth-small m-t-20"  method="POST" action=" {{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="control-label sr-only">{{ __('E-Mail Address') }}</label>
                        <input type="email" class="form-control round {{ ($errors->has('email')) ? ' is-invalid' : '' }}"
                               name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('info@example.com') }}"
                               required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif

                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label sr-only">{{ __('Password') }}</label>
                        <input type="password" class="form-control round {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               id="password" name="password" placeholder="{{ __('Password') }}" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif

                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>   {{ __('Remember Me') }}</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block"> {{ __('Login') }}</button>
                    <div class="bottom">
                    <span class="helper-text m-b-10">
                        <i class="fa fa-lock"></i>
                        @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                    </a>
                        @endif
                    </span>
                    </div>

                </form>
            </div>
@endsection
