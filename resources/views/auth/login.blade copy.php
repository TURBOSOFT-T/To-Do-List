@extends('front.layout')

<head>
    <title>User Profile</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{--
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> --}}

    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}
</head>
@section('main')
<style>
#color {
    border: 2px solid rgb(176, 49, 49);
    padding: 10px;
    border-radius: 50px 20px;
}

#text {
    border: 2px solid rgb(176, 49, 49);

}
</style>
<div class="row row-x-center s-styles">
    <div class="column large-6 tab-12">

        <!-- Session Status -->
        <x-auth.session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth.validation-errors :errors="$errors" />

        <div class="card" style="border-radius: 50px;" id="color">
            <div class="card-body p-5">
                <h2 class="text-uppercase text-center mb-5">WALLET VENDOR APPLICATION</h2>
                <form class="h-add-bottom" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->

                    <x-auth.input-email />


                    <!-- Password -->

                    <x-auth.input-password />


                    <!-- Remember Me -->
                    <label class="h-add-bottom">
                        <input id="remember_me" type="checkbox" name="remember_me" {{ old('remember_me') ? 'checked'
                            : '' }}>
                        <span class="label-text">@lang('Remember me')</span>
                    </label>

                    <x-auth.submit title="Login" />

                    <label class="h-add-bottom">
                        <a href="{{ route('password.request') }}">
                            @lang('Forgot Your Password?')
                        </a>
                        <div></div>
                        <div></div>
                        Apply for a New Wallet
                        Wallet Vendor Application
                        <a href="{{ route('register') }}" id="text" style="float: right;">
                            @lang('Not registered?')
                        </a>
                    </label>

                </form>
            </div>
        </div>
    </div>
</div>
<br>



<html lang="tr">

<head>
    <style type="text/css">
    .wrapper #error {
        background: red;
        color: white;
        padding: 5px;
        font-size: 18px;
        text-align: center;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    </style>




    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="logo.png">
    <title>Login Sayfası</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div id="wrapper" class="wrapper">
        <div id="login-title" class="title">Cüzdan Login</div>
        <form method="POST" action="{{ route('login') }}">
            <div class="field">
                <input name="mail" id="email" type="email" name="email" required="">
                <label>E-Posta Adresi</label>
            </div>
            <div class="field">
                <input type="password" name="password" name="password" required="">
                <label>Şifre</label>
            </div>
            <div class="content">
                <div class="checkbox">
                    <input type="checkbox" name="remember" id="remember-me">
                    <label for="remember-me">Beni hatırla</label>
                </div>
                <div class="pass-link">
                    <a href="{{ route('password.request') }}">Şifremi unuttum?</a>
                </div>
            </div>
            <div class="field">
                <input type="submit" value="Giriş Yap">
            </div>
            <div class="signup-link">
                Bir hesabınız yok mu?
                <a href="{{ route('register') }}">Şimdi Kaydolun!</a>
            </div>
        </form>
    </div>



</body>

</html>

@endsection
<br>

<style>
@import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap");

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

html,
body {
    display: grid;
    height: 100%;
    width: 100%;
    place-items: center;
    background: #f2f2f2;
}

::selection {
    background: #bb2782;
    color: #fff;
}

.wrapper {
    width: 380px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
}

.wrapper .title {
    font-size: 35px;
    font-weight: 600;
    text-align: center;
    line-height: 100px;
    color: #fff;
    user-select: none;
    border-radius: 15px 15px 0 0;
    background-color: #bb2782;
}

.wrapper form {
    padding: 10px 30px 50px 30px;
}

.wrapper form .field {
    height: 50px;
    width: 100%;
    margin-top: 20px;
    position: relative;
}

.wrapper form .field input {
    height: 100%;
    width: 100%;
    outline: none;
    font-size: 17px;
    padding-left: 20px;
    border: 1px solid lightgrey;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.wrapper form .field input:focus,
form .field input:valid {
    border-color: #bb2782;
}

.wrapper form .field label {
    position: absolute;
    top: 50%;
    left: 20px;
    color: #999999;
    font-weight: 400;
    font-size: 17px;
    pointer-events: none;
    transform: translateY(-50%);
    transition: all 0.3s ease;
}

form .field input:focus~label,
form .field input:valid~label {
    top: 0%;
    font-size: 16px;
    color: #bb2782;
    background: #fff;
    transform: translateY(-50%);
}

form .content {
    display: flex;
    width: 100%;
    height: 50px;
    font-size: 16px;
    align-items: center;
    justify-content: space-around;
}

form .content .checkbox {
    display: flex;
    align-items: center;
    justify-content: center;
}

form .content input {
    width: 15px;
    height: 15px;
    background: red;
}

form .content label {
    color: #262626;
    user-select: none;
    padding-left: 5px;
}

form .content .pass-link {
    color: "";
}

form .field input[type="submit"] {
    color: #fff;
    border: none;
    padding-left: 0;
    margin-top: -10px;
    font-size: 20px;
    font-weight: 500;
    cursor: pointer;
    background-color: #bb2782;
    transition: all 0.3s ease;
}

form .field input[type="submit"]:active {
    transform: scale(0.95);
}

form .signup-link {
    color: #262626;
    margin-top: 20px;
    text-align: center;
}

form .pass-link a,
form .signup-link a {
    color: #bb2782;
    text-decoration: none;
}

form .pass-link a:hover,
form .signup-link a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .wrapper {
        max-width: 90%;
    }
}

@media (max-width: 480px) {
    .wrapper {
        margin: 50px auto;
        padding: 10px;
    }
}
</style>