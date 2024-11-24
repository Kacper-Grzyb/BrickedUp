<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <title>Bricked Up</title>
</head>

<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background-image: url('{{ asset('img/gold-bricks-falling-d.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

    }

    body::before {
        content: "";
        background-color: rgba(0, 0, 0, 0.8);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .card-holder {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .card {
        position: relative;
        height: 600px;
        width: 400px;
        background: radial-gradient(circle at top left, rgba(0, 255, 0, 0.1), transparent 40%),
            radial-gradient(circle at top right, rgba(0, 255, 0, 0.1), transparent 40%),
            radial-gradient(circle at bottom left, rgba(0, 255, 0, 0.1), transparent 40%),
            radial-gradient(circle at bottom right, rgba(0, 255, 0, 0.1), transparent 40%);
        background-size: 100% 100%;
        background-position: top left, top right, bottom left, bottom right;
        background-color: rgba(0, 0, 0, 0.8);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: moveGradient 3s infinite alternate ease-in-out;
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

    .profile-photo {
        width: 250px;
        height: 250px;
        border-radius: 50%;
        margin-top: 35px;
        margin-bottom: 20px;
    }

    .input-fields {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        margin-top: 70px;
    }

    .input-fields form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
        width: 80%;
    }

    .input-container {
        position: relative;
        width: 100%;
        height: 45px;
    }

    .input-container img {
        position: absolute;
        left: 15px;
        top: 60%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
    }

    .input-container input {
        width: 83%;
        height: 100%;
        background-color: transparent;
        border: 2px solid rgba(255, 255, 255, 0.6);
        border-radius: 7px;
        padding-left: 50px;
        color: white;
        font-size: large;
        font-family: "Inter", sans-serif;
    }

    input::placeholder {
        color: rgba(255, 255, 255, 0.7);
        font-size: large;
        font-weight: 100;
        font-family: "Inter", sans-serif;
        cursor: pointer;
    }

    .input-fields form button {
        position: relative;
        width: 100%;
        height: 45px;
        background-color: transparent;
        border: 2px solid orange;
        border-radius: 7px;
        color: white;
        font-size: large;
        font-weight: 100;
        font-family: "Inter", sans-serif;
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

    .login:after {
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

    .login:hover {
        color: white;
        border: 0px #d19b26 solid;
    }

    .login:hover:before {
        opacity: .8;
    }

    .login:hover:after {
        top: 0;
    }

    .input-fields p {
        margin-top: -10px;
        color: rgba(255, 255, 255, 0.5);
        font-size: large;
        font-weight: 100;
        font-family: "Inter", sans-serif;
        cursor: pointer;
    }

    .input-fields p a {
        color: orange;
        text-decoration: none;
        opacity: 0.7;

    }

    .input-fields p a:hover {
        opacity: 1;
    }
</style>



<body>
    <div class="card-holder">
        <div class="card">
            <img class="profile-photo" src="/img/chuj.webp" alt="profile-image">
            <div class="input-fields">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-container">
                        <img src="/img/mail.png" alt="email icon">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                            autofocus>
                    </div>

                    @include('components.password-input')

                    <button type="submit" class="login">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <p class="forgot_pass"><a href="{{ route('password.request') }}">Forgot your password?</a></p>
                    @endif
                </form>

                <p>Don't have a profile? <a href="{{ route('register') }}">Sign up</a></p>

            </div>
        </div>
    </div>
</body>

</html>