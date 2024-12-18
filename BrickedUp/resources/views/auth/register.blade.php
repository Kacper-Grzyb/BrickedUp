<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <title>Bricked Up</title>
</head>

<style>
    body {
        margin: 0;
        padding: 0;
        height: 110vh;
        background-image: url('{{ asset('img/gold-bricks-falling-d.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    body::before {
        content: "";
        background-color: black;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 110%;
        opacity: 0.5;
        z-index: -1;
    }

    #left-menu {
        position: relative;
        background: radial-gradient(circle at top left, rgba(255, 215, 0, 0.1), transparent 40%),
            radial-gradient(circle at top right, rgba(255, 215, 0, 0.1), transparent 40%),
            radial-gradient(circle at bottom left, rgba(255, 215, 0, 0.1), transparent 40%),
            radial-gradient(circle at bottom right, rgba(255, 215, 0, 0.1), transparent 40%);
        background-size: 100% 100%;
        background-position: top left, top right, bottom left, bottom right;
        background-color: rgb(0, 0, 0, 0.8);
        width: 50%;
        height: inherit;
        color: white;
        animation: moveGradient 3s infinite alternate ease-in-out;
        border-radius: 15px;
    }

    @keyframes moveGradient {
        0% {
            background-size: 100% 100%;
        }

        50% {
            background-size: 150% 150%;
        }

        100% {
            background-size: 100% 100%;
        }
    }

    .main-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: Inter;
        font-optical-sizing: auto;
        font-weight: 100;
        font-style: normal;
    }

    .welcome-heading {
        font-size: 2.5rem;
        padding: 10px;
        margin: 15px;
    }

    .secondaty-text {
        font-size: 1.5rem;
        color: grey;
        padding: 10px;
        margin: 15px;
        text-align: center;
    }


    .input-fields {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px 0 25px;
    }

    .input-fields form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .input-container {
        position: relative;
        width: 500px;
        height: 45px;
    }

    .input-container img {
        position: absolute;
        left: 30px;
        top: 60%;
        transform: translateY(-50%);
        width: 24px;
        height: 24px;
    }

    .input-container input {
        width: 85%;
        height: 45px;
        background-color: transparent;
        border: 2px solid white;
        border-radius: 7px;
        padding-left: 66px;
        color: white;
        font-size: x-large;
        font-weight: 100;
        font-family: Inter;
    }

    .input-container input:hover {
        width: 86%;
        height: 47px;

    }

    input::placeholder {
        color: white;
        opacity: 0.7;
        font-size: x-large;
        font-weight: 100;
        font-family: Inter;
    }

    .input-fields form button {
        position: relative;
        width: 100%;
        height: 45px;
        background-color: transparent;
        border: 2px solid orange;
        border-radius: 7px;
        color: white;
        font-size: x-large;
        font-weight: 100;
        font-family: Inter;
        cursor: pointer;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        outline: 0;
        overflow: hidden;
        background: none;
        z-index: 1;
        cursor: pointer;
        transition: 0.08s ease-in;
        -o-transition: 0.08s ease-in;
        -ms-transition: 0.08s ease-in;
        -moz-transition: 0.08s ease-in;
        -webkit-transition: 0.08s ease-in;
    }

    .singup:after {
        content: "";
        position: absolute;
        background: #d19b26;
        bottom: 0;
        left: 0;
        right: 0;
        top: 100%;
        width: 100%;
        z-index: -2;
        -webkit-transition: all 250ms cubic-bezier(0.230, 1.000, 0.320, 1.000);
    }

    .singup:hover {
        color: white;
        border: 0px #d19b26 solid;
    }

    .singup:hover:before {
        opacity: .8;
    }

    .singup:hover:after {
        top: 0;
    }

    .separator {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin-bottom: 15px;
    }

    .separator p {
        font-family: Inter;
        font-optical-sizing: auto;
        font-weight: 100;
        font-style: normal;
        color: gray;
    }

    .separator::before,
    .separator::after {
        content: '';
        flex: 0.4;
        border-bottom: 1px solid gray;
    }

    .separator:not(:empty)::before {
        margin-right: .25em;
    }

    .separator:not(:empty)::after {
        margin-left: .25em;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 30px;
        padding: 10px;
        margin: 0;
    }

    .social-links>a>img {
        width: 40px;
        height: 40px;
    }

    .social-links>a>.lego {
        border-radius: 7px;
    }

    .text-red-600 {
        color: red;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    .mt-2 {
        margin-top: 0.5rem;
    }

    .input-container {
        position: relative;
        width: 500px;
        height: 45px;
        margin-bottom: 1rem;
    }
</style>

<body>



    <section id="left-menu">

        <div class="main-text">
            <p class="welcome-heading">WELCOME TO</p>
            <img src="/img/bu.png" alt="brickeduplogo" height="80px" width="430px">
            <p class="secondaty-text">
                LOG IN TO GET THE BEST EXPERIENCE AND <br>
                FULL ACCESS TO ALL OUR FEATURES.
            </p>
        </div>

        <div class="input-fields">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                @if ($errors->any())
                    <div class="text-red-600 text-sm mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="input-container">
                    <img src="/img/user.png" alt="user icon">
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" placeholder="Name" />
                </div>

                <div class="input-container">
                    <img src="/img/mail.png" alt="email icon">
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="username" placeholder="Email" />
                </div>

                <div class="input-container">
                    <img src="/img/password.png" alt="password icon">
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" placeholder="Password" />
                </div>

                <div class="input-container">
                    <img src="/img/password.png" alt="confirm password icon">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirm Password" />
                </div>

                <x-primary-button class="singup">
                    {{ __('Register') }}
                </x-primary-button>


            </form>
        </div>

        <div class="separator">
            <p>or</p>
        </div>

        <div class="social-links">
            <a href="#"><img class="lego" src="/img/lego.png" alt="facebook"></a>
            <a href="#"><img src="/img/facebook.png" alt="facebook"></a>
            <a href="#"><img src="/img/gmail.png" alt="facebook"></a>
            <a href="#"><img src="/img/twitter.png" alt="facebook"></a>
        </div>

    </section>

</body>

</html>