@extends('layouts.dash-mini')
@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one"
    style="background-image: url({{ url('dash/assets/images/auth/login_1.jpg') }}); background-size: cover;">
    <div class="row w-100">
        <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                    <div class="form-group">
                        <label class="label">Username</label>
                        <div class="input-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Password</label>
                        <div class="input-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary submit-btn btn-block">Login</button>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <div class="form-check form-check-flat mt-0">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                Keep me signed in </label>
                        </div>
                        @if(Route::has('password.request'))
                            <a class="text-small forgot-password text-black"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                </form>
            </div>
            <ul class="auth-footer">
                <li>
                    <a href="#">Conditions</a>
                </li>
                <li>
                    <a href="#">Help</a>
                </li>
                <li>
                    <a href="#">Terms</a>
                </li>
            </ul>
            <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
        </div>
    </div>
</div>

@endsection
