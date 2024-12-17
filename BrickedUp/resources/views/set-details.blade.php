<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>(Set Name) Set Details</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <!-- <link rel="stylesheet" href="{{ asset('css/uplot.css') }}"> -->
    <script src="https://unpkg.com/uplot@1.6.24/dist/uPlot.iife.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/uplot@1.6.24/dist/uPlot.min.css">



</head>

<body>

    {{-- Navbar goes here --}}
    <x-navbar :currentPage='"full-graph"' />

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
                    <p id="actual-price">$259.99</p>
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

    <div class="set-details-container" style="align-items: start">

        <div class="terminal-box set-details-reviews">
            <h2>User Reviews</h2>
            <div class="set-details-reviews-star-header">
                <img src="{{asset('images/full_star.svg')}}" alt="">
                <img src="{{asset('images/full_star.svg')}}" alt="">
                <img src="{{asset('images/full_star.svg')}}" alt="">
                <img src="{{asset('images/full_star.svg')}}" alt="">
                <img src="{{asset('images/full_star.svg')}}" alt="">
                <p>4.9 / 5</p>
            </div>
            <h6>28 reviews</h6>

            <div class="set-details-list">
                @include('components.review')
                @include('components.review')
                @include('components.review')
            </div>
        </div>
        
        <div class="set-details-subcontainer">
            <div class="terminal-box set-details-price-alerts">
                <h2 style="margin-bottom: 20px;">🔔 Set up price alert</h2>
                <h3>Set your alerts to receive a notification when a Lego set reaches its set goal.</h3>
                <div class="button-container">
                    <button class="box-button"><p>-5%</p></button>
                    <button class="box-button"><p>-10%</p></button>
                    <button class="box-button"><p>+5%</p></button>
                    <button class="box-button"><p>+10%</p></button>
                </div>
            </div>

            <div class="terminal-box set-details-for-sale">
                <h2>For Sale</h2>
                @include('components.for-sale-record')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Varying Amounts
            const varyingAmountElements = document.querySelectorAll(".varying-amount");
            varyingAmountElements.forEach(element => {
                const value = parseFloat(element.innerText);
                if (value > 0) {
                    element.classList.add("positive");
                    element.innerText = "+" + element.innerText;
                } else if (value < 0) element.classList.add("negative");
            

            // Price Alerts
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const alertButtons = document.querySelectorAll('.box-button');
            const setNumberElement = document.getElementById('set-number');
            const actualPriceElement = document.getElementById('actual-price');
            const setNumber = setNumberElement.textContent.trim();
            const actualPrice = parseFloat(actualPriceElement.textContent.replace('$', ''));

            alertButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const alertValue = this.textContent.trim();
                    const percent = parseFloat(alertValue.replace('%', ''));
                    const targetPrice = actualPrice * (1 + (percent / 100));

                    fetch('{{ route("price-alert.store") }}', {
                        method: 'POST',
                        headers:{
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            setNumber: setNumber,
                            targetPrice: targetPrice
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showAlertMessage(`We will notify you when "${setNumber}" reaches ${targetPrice.toLocaleString('en-US', { style: 'currency', currency: 'USD' })} (${alertValue} change).`);
                        } else{
                            showAlertMessage("There was an error setting your price alert.", true);
                        }
                    })
                    .catch(error => {
                        console.error('Error', error);
                        showAlertMessage("There was an error contacting the server.", true);
                    });
                });
            });

            function showAlertMessage(message, isError = false){
                const existingMessage = document.getElementById('success-message');
                if (existingMessage) existingMessage.remove();

                const msgTypeClass = isError ? 'error' : 'success';

                const alertBox = document.createElement('div');
                alertBox.id = "success-message";
                alertBox.className = `alert-message terminal-box ${msgTypeClass}`;
                alertBox.innerHTML = `<p>${message}</p>`;

                document.body.appendChild(alertBox);

                setTimeout(function() {
                    alertBox.style.transition = 'opacity 0.5s ease';
                    alertBox.style.opacity = '0';
                    setTimeout(() => alertBox.remove(), 500);
                }, 5000);
            }
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
