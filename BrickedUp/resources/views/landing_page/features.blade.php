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
            align-items: center;
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


        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .row {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-bottom: 20px;
        }

        .box {
            width: 300px;
            height: 300px;
            margin: 0 10px;
            color: white;
            padding: 20px;
            background-color: rgb(235, 144, 61, 0.9);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: left;
            align-items: start;
            text-align: left;
            font-family: Montserrat;
        }

        .box h3 {
            text-align: left;
            border-bottom: 1px solid white;
            padding-bottom: 20px;
            margin-bottom: 20px;
            width: 100%;
        }

        .box li {
            text-align: left;
        }

        .box p {
            text-align: left;
        }

        .box:hover {
            box-shadow: 0 0 20px rgba(235, 144, 61, 0.5);
        }

        .box li {
            padding: 5px;
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

    <div class="container">
        <div class="row">
            <div class="box">
                <h3>Insights</h3>
                <p>
                <ul>
                    <li>Historical Data</li>
                    <li>Daily updated charts</li>
                    <li>Advanced filtering</li>
                </ul>
                </p>
            </div>
            <div class="box">
                <h3>Analyze</h3>
                <p>
                <ul>
                    <li>Graph view for sets</li>
                    <li>Agregate prices of sets</li>
                    <li>Regional Breakdown</li>
                </ul>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="box">
                <h3>Monitoring</h3>
                <p>
                <ul>
                    <li>Customized allerts for prices</li>
                    <li>Alerts for spike in demand</li>
                    <li>Alerts for sun-setting sets</li>
                </ul>
                </p>
            </div>
            <div class="box">
                <h3>AI</h3>
                <p>
                <ul>
                    <li>Advanced predictions</li>
                    <li>AI insights</li>
                </ul>
                </p>
            </div>
        </div>
    </div>

    <footer>
        <!-- Add any footer content here -->
    </footer>
</body>

</html>