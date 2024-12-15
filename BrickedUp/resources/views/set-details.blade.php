<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>(Set Name) Set Details</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <x-navbar :currentPage='"set-details"'/>

    <div class="set-details-container">
        <div class="terminal-box set-details-text">
            <h2>Set Details</h2>

            <div class="set-details-list">
                <div class="set-details-row">
                    <h3>Set Number</h3>
                    <p id="set-number">10212</p>
                </div>
                <div class="set-details-row">
                    <h3>Name</h3>
                    <p id="set-name">Cloud City</p>
                </div>
                <div class="set-details-row">
                    <h3>Theme</h3>
                    <a href="#">Star Wars</a>
                </div>
                <div class="set-details-row">
                    <h3>Subtheme</h3>
                    <a href="#">Episode V</a>
                </div>
                <div class="set-details-row">
                    <h3>Year</h3>
                    <a href="#">2003</a>
                </div>
                <div class="set-details-row">
                    <h3>Availability</h3>
                    <a href="#">Retired</a>
                </div>
                <div class="set-details-row">
                    <h3>Pieces</h3>
                    <p>698</p>
                </div>
                <div class="set-details-row">
                    <h3>Minifigures</h3>
                    <p>7</p>
                </div>
            </div>
        </div>

        <div class="terminal-box set-details-media">
            <div class="set-image-carouselle">
                <img src="{{asset('images/placeholder_set_image1.jpg')}}" alt="placeholder lego set image">
                <img src="{{asset('images/placeholder_set_image3.jpg')}}" alt="placeholder lego set image">
                <img src="{{asset('images/placeholder_set_image1.jpg')}}" alt="placeholder lego set image">
                <img src="{{asset('images/placeholder_set_image3.jpg')}}" alt="placeholder lego set image">
                <img src="{{asset('images/placeholder_set_image1.jpg')}}" alt="placeholder lego set image">
                <img src="{{asset('images/placeholder_set_image3.jpg')}}" alt="placeholder lego set image">
            </div>
        </div>
    </div>

    <div class="set-details-container">
        <div class="terminal-box set-details-text"> 
            <h2>Set Pricing</h2>
            
            <div class="set-details-list">
                <div class="set-details-row">
                    <h3>Retail</h3>
                    <p>$87.99</p>
                </div>

                <p>New / Sealed</p>

                <div class="set-details-row">
                    <h3>Value</h3>
                    <p id="actual-price">$259.99</p>
                </div>
                <div class="set-details-row">
                    <h3>Price Variation</h3>
                    <p>$4500-$6000</p>
                </div>
                <div class="set-details-row">
                    <h3>Growth</h3>
                    <p class="varying-amount">6666.53%</p>
                </div>
                <div class="set-details-row">
                    <h3>Annual Growth</h3>
                    <p class="varying-amount">15.77%</p>
                </div>
                <div class="set-details-row">
                    <h3>90 Day Change</h3>
                    <p class="varying-amount">-1.32%</p>
                </div>
                <div class="set-details-row">
                    <h3>90 Day Sales Amount</h3>
                    <p>2</p>
                </div>
            </div>
        </div>

        <div class="terminal-box set-details-media">
            <h2>Set Value Chart</h2>
            <p>Insert Chart here</p>
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
                } else if (value < 0) {
                    element.classList.add("negative");
                }
            });

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
    </script>
</body>
</html>
