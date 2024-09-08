@extends('apps.layouts.app-auth')

@section('title', 'Enthusiast sign in instead')
@section('description', '')
@section('keywords', '')

@push('style')

@endpush

@push('script')

@endpush

@section('auth_content')

<!-- Login -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-4 mt-2">
                <a href="{{ url('/') }}" class="app-brand-link gap-2">
                    <img src="{{ asset('apps/img/nexes_01.png') }}" alt="" class="img-fluid d-block">
                </a>
            </div>
            <!-- /Logo -->

            <h4 class="mb-1 pt-2 text-center">{{ __('Welcome to MAHA2024') }}</h4>
            <p class="mb-4 text-center">{{ __('Please sign-in') }}</p>

            <form id="formAuthentication" class="mb-3" action="{{ route(__('login')) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email or username" autofocus>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        {{--<a href="{{ route( 'password.request') }}">
                            <small>{{ __('Forgot Password?') }}</small>
                        </a>--}}
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember-me">
                        <label class="form-check-label" for="remember-me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Sign in') }}</button>
                </div>
            </form>

        </div>
    </div>
    <!-- Login -->

@endsection
