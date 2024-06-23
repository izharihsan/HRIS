<!DOCTYPE html>
<html>

<head>
    <title>Login - Amore</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets') }}/img/favicon/trans.png" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets') }}/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>
    .roboto-thin {
        font-family: "Roboto", sans-serif;
        font-weight: 100;
        font-style: normal;
    }

    .roboto-light {
        font-family: "Roboto", sans-serif;
        font-weight: 300;
        font-style: normal;
    }

    .roboto-regular {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .roboto-medium {
        font-family: "Roboto", sans-serif;
        font-weight: 500;
        font-style: normal;
    }

    .roboto-bold {
        font-family: "Roboto", sans-serif;
        font-weight: 700;
        font-style: normal;
    }

    .roboto-black {
        font-family: "Roboto", sans-serif;
        font-weight: 900;
        font-style: normal;
    }

    .roboto-thin-italic {
        font-family: "Roboto", sans-serif;
        font-weight: 100;
        font-style: italic;
    }

    .roboto-light-italic {
        font-family: "Roboto", sans-serif;
        font-weight: 300;
        font-style: italic;
    }

    .roboto-regular-italic {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-style: italic;
    }

    .roboto-medium-italic {
        font-family: "Roboto", sans-serif;
        font-weight: 500;
        font-style: italic;
    }

    .roboto-bold-italic {
        font-family: "Roboto", sans-serif;
        font-weight: 700;
        font-style: italic;
    }

    .roboto-black-italic {
        font-family: "Roboto", sans-serif;
        font-weight: 900;
        font-style: italic;
    }
</style>

<body>
    <!-- <img class="wave" src="img/wave.png"> -->
    {{-- @if ($errors->any()) --}}
    <div class="alert alert-danger">
        <ul class="mb-0">
            asdasdads
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
{{-- @endif --}}
    <div class="container">
        <div class="img">
            <img src="{{ asset('/assets') }}/img/bg.svg">
        </div>



        <div class="login-content">
                <form id="formAuthentication" class="row g-3" action="{{ route('login_process') }}" method="POST">
                @csrf
                <img src="{{ asset('/assets') }}/img/avatar.svg">
                <h3 class="title">Selamat Datang di HRIS AMORE</h3>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <input id="email" type="text" class="input" placeholder="Masukkan Email" name="email"
                            value="" required oninvalid="this.setCustomValidity('Silakan isi Email Anda')"
                            oninput="setCustomValidity('')" autofocus>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <input id="password" type="password" class="input" placeholder="Masukkan Password"
                            name="password" value="" required
                            oninvalid="this.setCustomValidity('Silakan isi Password Anda')"
                            oninput="setCustomValidity('')">
                    </div>
                </div>
                <input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script src="{{ asset('/assets') }}/vendor/js/main.js"></script>
</body>

</html>
