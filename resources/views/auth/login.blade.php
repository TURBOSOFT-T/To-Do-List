@extends('front.layout')

<head>
    <title>Connexion</title>


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
</head>

<br>
<br>
<br>
<br>
<div id="wrapper" class="wrapper">
    <div id="login-title" class="title">Connexion</div>


{{-- 
    @livewire('auth.connexion') --}}
     <form class="h-add-bottom" method="POST" action="{{ route('login') }}">
        @csrf

       
        <div class="field">
           
            <label>E_mail</label>
            <input id="email" type="email" name="email"
                 required>
        </div>
        <div class="field">
           
            <label>Mot de passes</label>
            <input id="password"  type="password" name="password" required>
        </div>



      
       <div class="content">
            <div class="checkbox">

                <input id="remember_me" type="checkbox" name="remember_me">
                <label for="remember_me">Souvenir de moi</label>
            </div>
            <div class="pass-link">
                <a href="#">Mot de passe perdu?</a>
            </div>
        </div>
          <div class="field">
        <x-auth.submit title="connexion" />
          </div>

       <div class="signup-link">
        Pas de compte?
        <a href="{{ route('register') }}">Inscrivez vous ici!</a>
    </div>

    </form> 
</div>



<br>
<br>


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
