<!DOCTYPE html>
<html>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">

<head>
    <title>Grid Layout Example</title>
    <style>
        body {
            display: grid;
            grid-template-rows: auto 1fr auto;
            height: 100vh;
            margin: 0;
            background-image: url('{{ asset('img/gold-bricks-falling-d.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .main-title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
            font-family: Montserrat;
        }

        .sub-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
            font-family: Montserrat;
        }

        .btn-signup {
            font-family: Inter;
            text-decoration: none;
            margin: 0 10px;
            padding: 5px 10px;
            border: 1px solid;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        .btn-signup:hover {
            text-decoration: underline;
        }

        .signup-button {
            color: white;
            background-color: rgb(235, 144, 61);
            padding: 10px 20px;
            font-family: Inter;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .signup-button:hover {
            box-shadow: 0 0 20px rgba(235, 144, 61, 0.5);
        }
    </style>
</head>

<body>

    @include('components.home_navbar')

    <div class="main-content">
        <h1 class="main-title">Build your wealth brick-by-brick</h1>
        <h2 class="sub-title">All the tools to grow your lego investments</h2>
        <a href="/signup"><button class="signup-button">Sign Up</button></a>
    </div>

    <footer>
        <!-- Add any footer content here -->
    </footer>
</body>

</html>