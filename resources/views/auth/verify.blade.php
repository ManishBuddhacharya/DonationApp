{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.backend.layout.master')
@section('body')
    <body class="be-splash-screen">
    <div class="be-wrapper be-error be-error-404">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="error-container">
            <div class="error-number">{{ __('602') }}</div>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            <div class="error-description">Before proceeding, please check your email for a verification link</div>
            <div class="error-goback-text">If you did not receive the email</div>
            <div class="error-goback-button"><a href="{{ route('verification.resend') }}" class="btn btn-xl btn-primary">Resend Verification Code</a></div>
            <div class="footer">&copy; 2019 Donation</div>
          </div>
        </div>
      </div>
    </div>
  </body>
@endsection

