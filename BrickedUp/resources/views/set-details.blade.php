<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>(Set Name) Set Details</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <!-- <link rel="stylesheet" href="{{ asset('css/uplot.css') }}"> -->
    <script src="https://unpkg.com/uplot@1.6.24/dist/uPlot.iife.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/uplot@1.6.24/dist/uPlot.min.css">



</head>

<body>

    {{-- Navbar goes here --}}
    <x-navbar :currentPage='"full-graph"' />

    {{-- All of the values inside the fields are placeholders for now --}}
    <div class="set-details-container">
        <div class="terminal-box set-details-text">
            <h2>Set Details</h2>

            <div class="set-details-list">
                <div class="set-details-row">
                    <h3>Set Number</h3>
                    <p>{{ $setdetail->set_number }}</p>
                </div>
                <div class="set-details-row">
                    <h3>Name</h3>
                    <p> {{ $setdetail->set_name }} </p>
                </div>
                <div class="set-details-row">
                    <h3>Theme</h3>
                    <a href="#"> {{ $theme->theme ?? 'none' }} </a>
                </div>
                <div class="set-details-row">
                    <h3>Subtheme</h3>
                    <a href="#"> {{$subtheme->subtheme ?? 'none'}} </a>
                </div>
                <div class="set-details-row">
                    <h3>Year</h3>
                    <p> {{$setdetail->release_date}} </p>

                </div>
                <div class="set-details-row">
                    <h3>Availability</h3>
                    @if($setdetail->release_date > date('Y-m-d'))
                    <p>Available</p>
                    @else
                    <p>Retired</p>
                    @endif
                </div>
                <div class="set-details-row">
                    <h3>Pieces</h3>
                    <p> {{$setdetail->piece_count}} </p>
                </div>
                <div class="set-details-row">
                    <h3>Minifigures</h3>
                    <p> {{$setdetail->minifigures}} </p>
                </div>
            </div>
        </div>

        <div class="terminal-box set-details-media">
            {{-- Maybe make this a bit nicer in the future, will do for now --}}
            <div class="set-image-carouselle">
                <img src="data:image/jpeg;base64,{{ $image }}">
            </div>
        </div>

    </div>

    <div class=" set-details-container">

        <div class="terminal-box set-details-text">
            <h2>Set Pricing</h2>

            <div class="set-details-list">
                <div class="set-details-row">
                    <h3>Retail</h3>
                    <p> {{$lastPrice?->price}} </p>
                </div>

                <p>New / Sealed</p>

                <div class="set-details-row">
                    <h3>Value</h3>
                    <p>$5953.95</p>
                </div>
                <div class="set-details-row">
                    <h3>Price Variation</h3>
                    <p>no data yet</p>
                </div>
                <div class="set-details-row">
                    <h3>Growth</h3>
                    <p class="varying-amount">no data yet</p>
                </div>
                <div class="set-details-row">
                    <h3>Annual Growth</h3>
                    <p class="varying-amount">no data yet</p>
                </div>
                <div class="set-details-row">
                    <h3>90 Day Change</h3>
                    <p class="varying-amount">no data yet</p>
                </div>
                <div class="set-details-row">
                    <h3>90 Day Sales Amount</h3>
                    <p>no data yet</p>
                </div>
            </div>
        </div>

        <div class="terminal-box chart-to">
            <div id="chart"></div>
        </div>

    </div>

    

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const varyingAmountElements = document.querySelectorAll(".varying-amount") // Select all elements with the class 'varying-amount'

            varyingAmountElements.forEach(element => {
                const value = parseFloat(element.innerText);
                if (value > 0) {
                    element.classList.add("positive");
                    element.innerText = "+" + element.innerText;
                } else if (value < 0) element.classList.add("negative");
            });
        });

        const prices = @json($prices);

        // Extract dates and prices into separate arrays for the chart
        const dates = prices.map(price => new Date(price.record_date).getTime() / 1000); // Convert to UNIX timestamp
        const values = prices.map(price => price.price);

        const opts = {
            width: document.getElementById('chart').offsetWidth,
            height: document.getElementById('chart').offsetHeight,
            scales: {
                x: {
                    time: true, // x-axis as time
                },
                y: {
                    range: [0, Math.max(...values) * 1.2], // Add 20% padding above max value
                },
            },
            axes: [{
                    stroke: "black",
                    grid: {
                        show: false
                    }
                }, // X-axis
                {
                    stroke: "black",
                    grid: {
                        stroke: "rgba(0,0,0,0.1)"
                    }
                }, // Y-axis
            ],
            series: [{}, // X-axis
                {
                    stroke: "blue", // Line color
                    fill: "rgba(0, 0, 255, 0.1)", // Area under line color
                    width: 2,
                },
            ],
        };

        const data = [dates, values];


        const chartContainer = document.getElementById('chart');

        chartContainer.style.backgroundColor = 'lightblue';

        let u = new uPlot(opts, data, document.getElementById("chart"));
    </script>

</body>

</html>