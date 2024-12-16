<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>(Set Name) Set Details</title>
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
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
                    <p> {{$prices?->price}} </p>
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

        <div class="terminal-box set-details-media">
            <h2>Set Value Chart</h2>
            <div id="chartWrapper" class="my-chartWrapper">
                <div id="mountainChart" class="my-mountainChart">
                    <div id="placeholder" class="placeholder-message">
                        Select a LEGO set to display its data on the chart.
                    </div>
                    <div id="loading" class="loading-spinner" style="display: none">
                        Loading...
                    </div>
                </div>
                <div id="legend">
                    <!-- Dynamic Legend Items -->
                </div>
            </div>
        </div>

    </div>

    <div class="set-details-container" style="align-items: start">


        <div class="set-details-subcontainer">
            <div class="terminal-box set-details-trends">
                <h2>Sales Trends</h2>
                <p>maybe chart</p>
            </div>

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
    </script>

</body>

</html>

<script>
    window.setsData = @json($sets);
</script>
