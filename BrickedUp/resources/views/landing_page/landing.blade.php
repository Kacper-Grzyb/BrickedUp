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
        /* CSS styles for the layout */
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

        /* Top navigation bar */
        .top-bar {
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar .title {
            font-size: 20px;
            font-weight: bold;
            margin-left: 10px;
            font-family: Montserrat;
        }

        .top-bar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .top-bar .nav-links {
            display: flex;
            justify-content: center;
            flex-grow: 1;
            font-family: Inter;
        }

        .top-bar .nav-links a {
            text-decoration: none;
            margin: 0 10px;
            padding: 5px 10px;
            /* Add padding to the links */
            border: 1px solid;
            /* Add a transparent border */
            border-radius: 4px;
            /* Add some rounded corners */
            transition: border-color 0.3s ease;
            /* Add a transition for the border color */
        }

        .top-bar .nav-links a:hover {
            text-decoration: underline;
        }

        /* Main content area */
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
            /* Add padding to the links */
            border: 1px solid;
            /* Add a transparent border */
            border-radius: 4px;
            /* Add some rounded corners */
            transition: border-color 0.3s ease;
            /* Add a transition for the border color */
        }

        .btn-signup:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>
    <div class="top-bar">
        <div class="title">
            <a href="/">BrickedUp</a>
        </div>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="#">About</a>
            <a href="/features">Features</a>
            <a href="#">Pricing</a>
            <a href="mailto:info@pornhub.com">Contact</a>
        </div>
        <a class="btn-signup" href="/signup">Sign Up</a>
        
    </div>

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