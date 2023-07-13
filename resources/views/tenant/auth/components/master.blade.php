<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restopia - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png">
</head>

<body>
    @include('sweetalert::alert')
    <div id="auth">

        <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('login') }}"><img src="{{ asset('assets/images/logo/logo.svg') }}"
                                alt="Logo"></a>
                    </div>

                    @yield('container')

                </div>
    </div>
</body>

</html>
