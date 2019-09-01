{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}



@extends('layouts.backend.layout.master')
@section('body')
    <div class="be-splash-screen">
        <div class="be-wrapper be-login">
          <div class="be-content">
            <div class="main-content container-fluid">
              <div class="splash-container forgot-password">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                  <div class="panel-heading"><img src="assets/images/logo.png" alt="logo" width="102" height="27" class="logo-img"><span class="splash-description">Forgot your password?</span></div>
                  <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                      <p>Don't worry, we'll send you an email to reset your password.</p>
                      <div class="form-group xs-pt-20">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="alert alert-danger invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <p class="xs-pt-5 xs-pb-20">Don't remember your email? <a href="#">Contact Support</a>.</p>
                      <div class="form-group xs-pt-5">
                        <button type="submit" class="btn btn-block btn-primary btn-xl">Reset Password</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="splash-footer">&copy; 2016 Your Company</div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
