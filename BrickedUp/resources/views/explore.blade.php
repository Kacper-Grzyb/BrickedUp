<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Sets</title>
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

    .graph {
        border: 1px solid white;
        border-radius: 15px;
        margin: 25px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        padding: 20px;
    }

    #pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination {
        display: flex;
        gap: 10px;
        list-style: none;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 8px 16px;
        background-color: #333;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .pagination a:hover,
    .pagination .active {
        background-color: #ff7f00;
        cursor: pointer;
    }
</style>

<body>
    <section id="navbar">
        @include('components.navbar', ['currentPage' => 'explore-view'])
    </section>

    <section id="live-prices">

    </section>

    <section id="explore-view">
        @foreach ($sets as $set)
            <div class="content">
                <div class="column one">
                    @if ($set->setImage && $set->setImage->first())
                        <img src="data:image/png;base64,{{ $set->setImage->first()->image_data }}"
                            style="height: 200px; width: 200px;" alt="Set Image">
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                <div class="column two">
                    <div class="text">
                        <h1 id="set-details" class="heading">
                            LEGO {{ $set->set_number }} | {{ $set->set_name }}
                        </h1>
                        <hr>
                        <div class="description">
                            <div class="left-details">
                                <p>Available:
                                    @if($set->availability)
                                        {{ $set->availability->availability }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                                <p>PIECES: {{ $set->piece_count }}</p>
                                <p>THEME: {{ $set->theme->theme }}</p>
                                <p>PRICE: <span
                                        style="color: orange;">{{ $set->retail_price ? '$' . $set->retail_price : 'Not available' }}</span>
                                </p>
                            </div>
                            <div class="right-details">
                                @if ($set->description)
                                    <p>{{ $set->description }}</p>
                                @else
                                    <p>No description available</p>
                                @endif
                            </div>
                        </div>
                        <div class="socials">
                            <p>Check on: </p>
                            <a href="https://www.ebay.com/sch/i.html?_nkw=LEGO+{{ $set->set_number }}" target="_blank">
                                <img src="/img/ebay.png" alt="ebay-logo" width="60px" height="40px">
                            </a>
                            <a href="https://www.amazon.com/s?k=LEGO+{{ $set->set_number }}" target="_blank">
                                <img src="/img/amazon.png" alt="amazon-logo" width="60px" height="30px"
                                    style="margin-top: 10px;">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="column three">
                    <div class="graph">
                        <canvas id="barChart{{ $set->set_number }}"></canvas>
                    </div>
                </div>
            </div>
        @endforeach



        <section id="pagination">
            <div class="pagination">
                {{ $sets->links() }}
            </div>
        </section>


    </section>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @foreach ($sets as $set)
                    var ctx = document.getElementById("barChart{{ $set->set_number }}").getContext('2d');
                    var data = {
                        labels: ['Availability', 'Piece Count', 'Retail Price'],
                        datasets: [{
                            label: 'LEGO Set {{ $set->set_number }}',
                            data: [
                                @if($set->availability) {{ $set->availability->id }} @else 0 @endif,
                                                                                                                                                                    {{ $set->piece_count }},
                            @if($set->retail_price) {{ $set->retail_price }} @else 0 @endif
                                                                                                                                                                ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                            borderWidth: 1
                }]
                                                                                                                                                        };
                var config = {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };
                var myChart = new Chart(ctx, config);
            @endforeach
        });
    </script>

</body>

</html>