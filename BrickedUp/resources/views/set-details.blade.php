<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Set Name Set Details</title>
</head>
<body>
    {{-- All of the values inside the fields are placeholders for now --}}
    <div class="set-details-container">
        <div class="terminal-box set-details-text">
            <h2>Set Details</h2>

            <div class="set-details-list">
                <div class="set-details-row">
                    <h3>Set Number</h3>
                    <p>10123</p>
                </div>
                <div class="set-details-row">
                    <h3>Name</h3>
                    <p>Cloud City</p>
                </div>
                <div class="set-details-row">
                    <h3>Theme</h3>
                    <a href="google.com">Star Wars</a>
                </div>
                <div class="set-details-row">
                    <h3>Subtheme</h3>
                    <a href="google.com">Episode V</a>
                </div>
                <div class="set-details-row">
                    <h3>Year</h3>
                    <a href="google.com">2003</a>
                </div>
                <div class="set-details-row">
                    <h3>Availability</h3>
                    <a href="google.com">Retired</a>
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
            {{-- Maybe make this a bit nicer in the future, will do for now --}}
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
                    <p>$5953.95</p>
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
                <div class="set-details-review">
                    <header>
                        <img src="{{ asset('images/lego-head-icon.png') }}" alt="User Profile Icon">
                        <h5> Brickipedia </h5>
                        <div class="set-details-review-stars">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/empty_star.svg')}}" alt="">
                        </div>
                        <p> 4/5 </p>
                    </header>
                    <p>It was most notable for being the first appearance of a Lando  Calrissian Minifigure. This set is also the only set released so far  that features Lando in his most recognized clothing (the other being on  6210 Jabba's Sail Barge where he is in disguise).</p>
                </div>

                <div class="set-details-review">
                    <header>
                        <img src="{{ asset('images/lego-head-icon.png') }}" alt="User Profile Icon">
                        <h5> Brickipedia </h5>
                        <div class="set-details-review-stars">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/empty_star.svg')}}" alt="">
                        </div>
                        <p> 4/5 </p>
                    </header>
                    <p>It was most notable for being the first appearance of a Lando  Calrissian Minifigure. This set is also the only set released so far  that features Lando in his most recognized clothing (the other being on  6210 Jabba's Sail Barge where he is in disguise).</p>
                </div>

                <div class="set-details-review">
                    <header>
                        <img src="{{ asset('images/lego-head-icon.png') }}" alt="User Profile Icon">
                        <h5> Brickipedia </h5>
                        <div class="set-details-review-stars">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/full_star.svg')}}" alt="">
                            <img src="{{asset('images/empty_star.svg')}}" alt="">
                        </div>
                        <p> 4/5 </p>
                    </header>
                    <p>It was most notable for being the first appearance of a Lando  Calrissian Minifigure. This set is also the only set released so far  that features Lando in his most recognized clothing (the other being on  6210 Jabba's Sail Barge where he is in disguise).</p>
                </div>
            </div>
        </div>

        <div class="set-details-subcontainer">
            <div class="terminal-box set-details-trends">
                <h2>Sales Trends</h2>
                <p>Insert chart here</p>
            </div>
    
            <div class="terminal-box set-details-for-sale">
                <h2>For Sale</h2>

                <div class="for-sale-record">
                    <img src="{{asset('images/ebay.svg')}}" alt="platform-logo">
                    <h5>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi, magnam!</h5>
                    <p>EU</p>
                    <p class="for-sale-price">$4839,99</p>
                </div>

                <div class="for-sale-record">
                    <img src="{{asset('images/ebay.svg')}}" alt="platform-logo">
                    <h5>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi, magnam!</h5>
                    <p>EU</p>
                    <p class="for-sale-price">$4839,99</p>
                </div>

                <div class="for-sale-record">
                    <img src="{{asset('images/ebay.svg')}}" alt="platform-logo">
                    <h5>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi, magnam!</h5>
                    <p>EU</p>
                    <p class="for-sale-price">$4839,99</p>
                </div>

            </div>
        </div>

    </div>

    <script>

        document.addEventListener("DOMContentLoaded", function() {
            const varyingAmountElements = document.querySelectorAll(".varying-amount") // Select all elements with the class 'varying-amount'

            varyingAmountElements.forEach(element => {
                const value = parseFloat(element.innerText);
                if(value > 0) {
                    element.classList.add("positive");
                    element.innerText = "+" + element.innerText;
                }
                    
                else if (value < 0) element.classList.add("negative");
            });
        });

    </script>

</body>
</html>