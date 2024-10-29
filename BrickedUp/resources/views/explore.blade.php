<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    body {
        background-color: white;
        background-color: black;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    #explore-view {
        display: flex;
        flex-direction: column;
        gap: 40px;
        align-items: center;
        margin-top: 10rem;
    }

    h1 {
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: bold;
    }

    .content {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
        width: 90%;
        min-width: 400px;
        border: 2px solid white;
        border-radius: 10px;
        color: white;
    }

    .one>img {
        width: 325px;
        height: 224px;
        margin: 15px;
        padding: 15px;
    }

    .description {
        display: grid;
        grid-template-columns: 1fr 3fr;
        gap: 10px;
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 100;
        font-style: normal;
    }

    .socials {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        float: right;
        margin-bottom: 10px;
    }

    .graph {
        width: 250px;
        height: 250px;
        border: 1px solid white;
        border-radius: 15px;
        margin: 25px;
    }

    .column.three {
        display: grid;
        place-items: center;
    }

    @media (max-width: 1024px) {
        .content {
            grid-template-columns: 1fr;
            width: 75%;
            padding: 10px;
        }

        .column.one,
        .column.three {
            display: flex;
            justify-content: center;
        }

        .description {
            grid-template-columns: 1fr;
        }

        .heading {
            font-size: 1.2rem;
            text-align: center;
        }

        .left-details,
        .right-details {
            font-size: 0.9rem;
            text-align: center;
        }

        .socials {
            justify-content: center;
            float: none;
            margin-top: 1rem;
        }
    }


    @media (max-width: 767px) {
        .content {
            grid-template-columns: 1fr;
            width: 75%;
            padding: 10px;
        }

        .column.one,
        .column.three {
            display: flex;
            justify-content: center;
        }

        .description {
            grid-template-columns: 1fr;
        }

        .heading {
            font-size: 1.2rem;
            text-align: center;
        }

        .left-details,
        .right-details {
            font-size: 0.9rem;
            text-align: center;
        }

        .socials {
            justify-content: center;
            float: none;
            margin-top: 1rem;
        }
    }
</style>

<body>
    <section id="navbar">

    </section>

    <section id="live-prices">

    </section>

    <section id="explore-view">

        <div class="content">
            <div class="column one">
                <img src="/img/f1.jpeg" alt="zoom">
            </div>

            <div class="column two">
                <div class="text">
                    <h1 id="set-details" class="heading">
                        LEGO 4231 | Mercedes - AMG F1 W14 E Performance
                    </h1>
                    <hr>
                    <div class="description">
                        <div class="left-details">
                            <p>AGE: 18+</p>
                            <p>PIECES: 2342</p>
                            <p>THEME: Techninc</p>
                            <p>PRICE: <span style="color: orange;">269.90$</span></p>
                        </div>
                        <div class="right-details">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Aliquam enim delectus illo ab, soluta, ratione excepturi quia numquam
                                mollitia reprehenderit, dolores pariatur? Ad veniam nisi impedit vero
                                alias hic nulla!
                            </p>
                        </div>

                    </div>
                    <div class="socials">
                        <p>Check on: </p>
                        <a href="https://www.ebay.com">
                            <img src="/img/ebay.png" alt="ebay-logo" width="60px" height="40px">
                        </a>
                        <a href="https://www.amazon.com">
                            <img src="/img/amazon.png" alt="amazon-logo" width="60px" height="30px"
                                style="margin-top: 10px;">
                        </a>
                    </div>
                </div>
            </div>
            <div class="column three">
                <div class="graph">

                </div>
            </div>



        </div>

        <div class="content">
            <div class="column one">
                <img src="/img/f1.jpeg" alt="zoom">
            </div>

            <div class="column two">
                <div class="text">
                    <h1 id="set-details" class="heading">
                        LEGO 4231 | Mercedes - AMG F1 W14 E Performance
                    </h1>
                    <hr>
                    <div class="description">
                        <div class="left-details">
                            <p>AGE: 18+</p>
                            <p>PIECES: 2342</p>
                            <p>THEME: Techninc</p>
                            <p>PRICE: <span style="color: orange;">269.90$</span></p>
                        </div>
                        <div class="right-details">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Aliquam enim delectus illo ab, soluta, ratione excepturi quia numquam
                                mollitia reprehenderit, dolores pariatur? Ad veniam nisi impedit vero
                                alias hic nulla!
                            </p>
                        </div>

                    </div>
                    <div class="socials">
                        <p>Check on: </p>
                        <a href="https://www.ebay.com">
                            <img src="/img/ebay.png" alt="ebay-logo" width="60px" height="40px">
                        </a>
                        <a href="https://www.amazon.com">
                            <img src="/img/amazon.png" alt="amazon-logo" width="60px" height="30px"
                                style="margin-top: 10px;">
                        </a>
                    </div>
                </div>
            </div>
            <div class="column three">
                <div class="graph">

                </div>
            </div>



        </div>

        <div class="content">
            <div class="column one">
                <img src="/img/f1.jpeg" alt="zoom">
            </div>

            <div class="column two">
                <div class="text">
                    <h1 id="set-details" class="heading">
                        LEGO 4231 | Mercedes - AMG F1 W14 E Performance
                    </h1>
                    <hr>
                    <div class="description">
                        <div class="left-details">
                            <p>AGE: 18+</p>
                            <p>PIECES: 2342</p>
                            <p>THEME: Techninc</p>
                            <p>PRICE: <span style="color: orange;">269.90$</span></p>
                        </div>
                        <div class="right-details">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Aliquam enim delectus illo ab, soluta, ratione excepturi quia numquam
                                mollitia reprehenderit, dolores pariatur? Ad veniam nisi impedit vero
                                alias hic nulla!
                            </p>
                        </div>

                    </div>
                    <div class="socials">
                        <p>Check on: </p>
                        <a href="https://www.ebay.com">
                            <img src="/img/ebay.png" alt="ebay-logo" width="60px" height="40px">
                        </a>
                        <a href="https://www.amazon.com">
                            <img src="/img/amazon.png" alt="amazon-logo" width="60px" height="30px"
                                style="margin-top: 10px;">
                        </a>
                    </div>
                </div>
            </div>
            <div class="column three">
                <div class="graph">

                </div>
            </div>



        </div>


    </section>

</body>

</html>