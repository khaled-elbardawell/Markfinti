@extends('layouts.app')

@section('content')

    <div class="card forgot-pass">
        <div class="body">
            <p class="lead mb-3"><strong>Oops</strong>,<br> forgot something?</p>
            <p>Type email to recover password.</p>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-auth-small" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control round {{ ($errors->has('email')) ? ' is-invalid' : '' }}"
                           name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('info@example.com') }}"
                           autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit"
                        class="btn btn-round btn-primary btn-lg btn-block">{{ __('Send Password Reset Link') }}</button>
                <div class="bottom">
                    <span class="helper-text">Know your password? <a href="{{route('login')}}">Login</a></span>
                </div>
            </form>
        </div>
    </div>
@endsection
