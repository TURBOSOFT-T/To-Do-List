@extends('front.layout')

<html lang="tr">

<head>


    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="author" content="">
    {{--
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> --}}

    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'> --}}

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="sign-up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <script src="{{ url('assets/js/userprofile.js') }}"></script>

</head>
<style>
    .img-circle {
        border-radius: 50%;
    }

    @media (max-width: 767.98px) {
        .sidebar-wrapper {
            position: static;
            width: inherit;
        }
    }

    @media (min-width: 992px) {
        .skillset .level-title {
            display: inline-block;
            float: left;
            width: 30%;
            margin-bottom: 0;
        }
    }

    #cadre {
        border: 2px solid red;
        padding: 10px;
        border-radius: 50px 40px;


    }
</style>


<body>
    <section class="container">

        <!-- Validation Errors -->
        <x-auth.validation-errors :errors="$errors" />
        <header>Inscription</header>
    
        </form>
        <div  >
            <form method="POST" action="{{ route('register') }}" class="form" enctype="multipart/form-data">
                @csrf
                
                <div class="column">
                    <div class="input-box">
                        <label>Prénom</label>
                        <input name="first_name" id="first_name" type="text" placeholder="Prénom" required />
                    </div>
                    <div class="input-box">
                        <label>Nom</label>
                        <input type="text" id="last_name" placeholder="Nom" required name="last_name" />
                    </div>
                </div>


                <x-auth.input-email />

                <div class="column">
                    <div class="input-box">
                        <label>Mot de passe</label>
                        <input name="password" type="password" placeholder="Mot de passe" required />
                    </div>
                    <div class="input-box">
                        <label for="password_confirmation">Confirmation</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirmation" required />


                    </div>
                </div>
            
              
              


                <div class="form-actions">
                    <button type="submit" name="insertislemi">Confirmation</button>

                </div>
            </form>
        </div>




    

        @php

        /**
        * Alert
        */
        $message = '';
        $icon = '';

        if (!empty($errors->all())) {
        $icon = 'error';
        $message = $errors->first();
        } elseif (session()->has('success')) {
        $icon = 'success';
        $message = session()->get('success');
        } elseif (session()->has('error')) {
        $icon = 'error';
        $message = session()->get('error');
        } elseif (!empty($success)) {
        $icon = 'success';
        $message = $success;
        }

        @endphp

        <script>
            var Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000
                });
                var message = '{{ $message }}';
                var icon = '{{ $icon }}';
                if (message.length > 0) {
                    Toast.fire({
                        icon: icon,
                        title: message
                    });
                }
        </script>

        <script>
            function saverecord() {
                    $("#submitbtn").trigger('click');
                }

                /**
                 *  Display Image
                 */
                function display_image(input) {

                    if (input.files && input.files[0]) {

                        var reader = new FileReader();
                        reader.onload = function(e) {

                            $(input).closest('div').find('.box-image-preview').attr('src', e.target.result);
                        };

                        reader.readAsDataURL(input.files[0]);
                    }

                }
        </script>


 


    </section>





</body>

</html>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px;
        background: #fff;
    }

    .container {
        position: relative;
        max-width: 900px;
        width: 100%;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .container header {
        font-size: 1.5rem;
        color: #333;
        font-weight: 500;
        text-align: center;
    }

    .container .form {
        margin-top: 30px;
    }

    .form .input-box {
        width: 100%;
        margin-top: 20px;
    }

    .input-box label {
        color: #333;
    }

    .form :where(.input-box input, .select-box) {
        position: relative;
        height: 50px;
        width: 100%;
        outline: none;
        font-size: 1rem;
        color: #707070;
        margin-top: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 0 15px;
    }

    .input-box input:focus {
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
    }

    .form .column {
        display: flex;
        column-gap: 15px;
    }

    .form .gender-box {
        margin-top: 20px;
    }

    .gender-box h3 {
        color: #333;
        font-size: 1rem;
        font-weight: 400;
        margin-bottom: 8px;
    }

    .form :where(.gender-option, .gender) {
        display: flex;
        align-items: center;
        column-gap: 50px;
        flex-wrap: wrap;
    }

    .form .gender {
        column-gap: 5px;
    }

    .gender input {
        accent-color: #343434;
    }

    .form :where(.gender input, .gender label) {
        cursor: pointer;
    }

    .gender label {
        color: #707070;
    }

    .address :where(input, .select-box) {
        margin-top: 15px;
    }

    .payment :where(input, .select-box) {
        margin-top: 2px;
    }

    .select-box select {
        height: 100%;
        width: 100%;
        outline: none;
        border: none;
        color: #707070;
        font-size: 1rem;
    }

    .form button {
        height: 55px;
        width: 100%;
        color: #fff;
        font-size: 1rem;
        font-weight: 400;
        margin-top: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #bb2782;
    }

    .form button:hover {
        background: rgba(187, 39, 130, 0.8);
    }

    /*Responsive*/
    @media screen and (max-width: 500px) {
        .form .column {
            flex-wrap: wrap;
        }

        .form :where(.gender-option, .gender) {
            row-gap: 15px;
        }
    }

    .upload {
        width: 100px;
        position: relative;
        margin: auto;
    }

    .upload img {
        border-radius: 50%;
        border: 6px solid #eaeaea;
    }

    .upload .round {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #bb2782;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
    }

    .upload .round input[type="file"] {
        position: absolute;
        transform: scale(2);
        opacity: 0;
    }

    input[type="file"]::-webkit-file-upload-button {
        cursor: pointer;
    }
</style>




