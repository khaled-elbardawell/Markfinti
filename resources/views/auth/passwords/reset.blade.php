@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">

            <div class="body">

                <p class="lead">{{ __('Reset Password') }} </p>

                <form class="form-auth-small m-t-20" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">



                    <div class="form-group">
                        <label for="email" class="control-label col-form-label">{{ __('E-Mail Address') }}</label>
                        <input type="email" class="form-control round {{ ($errors->has('email')) ? ' is-invalid' : '' }}"
                               name="email" id="email" value="{{ $email ?? old('email') }}"
                               required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div>



                    <div class="form-group">
                        <label for="password" class="control-label col-form-label">{{ __('Password') }}</label>
                        <input type="password" class="form-control round {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               id="password" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif

                    </div>




                    <div class="form-group">
                        <label for="password-confirm" class="control-label col-form-label">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control round"
                               id="password-confirm" name="password_confirmation" required>
                    </div>




                    <button type="submit" class="btn btn-primary btn-round btn-block">  {{ __('Reset Password') }} </button>



                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
