<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>{{ __('login') }}</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<style>
    * {
        box-sizing: border-box;
    }

    html {
        height: 100%;
    }

    body {
        background-color: #354152;
        color: #7e8ba3;
        font: 300 1rem/1.5 Helvetica Neue, sans-serif;
        margin: 0;
        min-height: 100%;
    }

    .align {
        align-items: center;
        display: flex;
        flex-direction: row;
    }

    .align__item--start {
        align-self: flex-start;
    }

    .align__item--end {
        align-self: flex-end;
    }

    .site__logo {
        margin-bottom: 2rem;
    }

    input {
        border: 0;
        font: inherit;
    }

    input::placeholder {
        color: #7e8ba3;
    }

    .form__field {
        margin-bottom: 1rem;
    }

    .form input {
        outline: 0;
        padding: 0.5rem 1rem;
    }

    .form input[type=email],
    .form input[type=password] {
        width: 100%;
    }

    .grid {
        margin: 0 auto;
        max-width: 25rem;
        width: 100%;
    }

    h2 {
        font-size: 2.75rem;
        font-weight: 100;
        margin: 0 0 1rem;
        text-transform: uppercase;
    }

    svg {
        height: auto;
        max-width: 100%;
        vertical-align: middle;
    }

    a {
        color: #7e8ba3;
    }

    .register {
        box-shadow: 0 0 250px #000;
        text-align: center;
        padding: 4rem 2rem;
    }

    .register input {
        border: 1px solid #242c37;
        border-radius: 999px;
        background-color: transparent;
        text-align: center;
    }

    .register input[type=email],
    .register input[type=password] {
        background-repeat: no-repeat;
        background-size: 1.5rem;
        background-position: 1rem 50%;
    }

    .register input[type=email] {
        background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#242c37"><path d="M256.017 273.436l-205.17-170.029h410.904l-205.734 170.029zm-.034 55.462l-205.983-170.654v250.349h412v-249.94l-206.017 170.245z"/></svg>');
    }

    .register input[type=password] {
        background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#242c37"><path d="M195.334 223.333h-50v-62.666c0-61.022 49.645-110.667 110.666-110.667 61.022 0 110.667 49.645 110.667 110.667v62.666h-50v-62.666c0-33.452-27.215-60.667-60.667-60.667-33.451 0-60.666 27.215-60.666 60.667v62.666zm208.666 30v208.667h-296v-208.667h296zm-121 87.667c0-14.912-12.088-27-27-27s-27 12.088-27 27c0 7.811 3.317 14.844 8.619 19.773 4.385 4.075 6.881 9.8 6.881 15.785v22.942h23v-22.941c0-5.989 2.494-11.708 6.881-15.785 5.302-4.93 8.619-11.963 8.619-19.774z"/></svg>');
    }

    .register input[type=submit] {
        background-image: linear-gradient(160deg, #8ceabb 0%, #378f7b 100%);
        color: #fff;
        margin-bottom: 6rem;
        width: 100%;
    }
</style>

<body class="align">

    <div class="grid align__item">

        <div class="register">

            <svg xmlns="http://www.w3.org/2000/svg" class="site__logo" width="56" height="84" viewBox="77.7 214.9 274.7 412">
                <defs>
                    <linearGradient id="a" x1="0%" y1="0%" y2="0%">
                        <stop offset="0%" stop-color="#8ceabb" />
                        <stop offset="100%" stop-color="#378f7b" />
                    </linearGradient>
                </defs>
                <path fill="url(#a)" d="M215 214.9c-83.6 123.5-137.3 200.8-137.3 275.9 0 75.2 61.4 136.1 137.3 136.1s137.3-60.9 137.3-136.1c0-75.1-53.7-152.4-137.3-275.9z" />
            </svg>

            <h2>{{ __('login') }}</h2>

            <form method="POST" action="{{ route('login') }}" class="form">
                @csrf
                <div class="form__field">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form__field">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form__field">
                    <input type="submit" value="{{ __('login') }}">

                </div>

            </form>



        </div>

    </div>

</body>

</html>


{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
