<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fonts.googleapis.css') }}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('css/main/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/input-date.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/upload-file.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/select.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/input.css') }}" rel="stylesheet">

</head>

<body>

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">
                                            {{ __('Login') }}
                                        </h5>
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST" action="{{ route('login') }}"
                                        novalidate>
                                        @csrf
                                        <div class="col-12">


                                            <div class="form-floating input-group has-validation">
                                                <input id="email" type="email" placeholder=""
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>
                                                <label class="form-label">{{ __('Email Address') }}</label>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <div class="form-floating input-group has-validation">
                                                <input id="password" type="password" placeholder=""
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">
                                                <label class="form-label">{{ __('Password') }}</label>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check with-label">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }} />
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>

                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link text-center w-100"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                            {{-- <button class="btn btn-primary w-100" type="submit">
                                                Մուտք գործել
                                            </button> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

</body>

</html>
