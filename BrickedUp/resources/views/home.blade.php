<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>BrickedUp - Home</title>
</head>

<body>
    @include('components.navbar', ['currentPage' => 'home'])

    <div class="home-top-ranked-container" style="align-items: start">
        
        <div class="home-top-ranked-subcontainer">
            
            <div class="terminal-box home-container">   
                <a href="full-graph" style="text-decoration: none; color: inherit;">
                    <h1>LEGO Set Market Price/Time Comparison</h1>
                </a>
                    <div id="chartContainer">
                        <canvas id="legoChart"></canvas>
                    </div>
                
                <script>
                    //Static Sample Data, CHANGE AFTER DEMO
                    const legoSetData = {
                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                        datasets: [
                            {
                                label: "City Police HQ",
                                data: [100, 105, 110, 120, 125, 130, 135],
                                borderColor: "rgba(75, 192, 192, 1)",
                                backgroundColor: "rgba(75, 192, 192, 0.2)",
                                tension: 0.3
                            },
                            {
                                label: "Donkey Kong BMW",
                                data: [90, 92, 95, 100, 105, 110, 115],
                                borderColor: "rgba(255, 99, 132, 1)",
                                backgroundColor: "rgba(255, 99, 132, 0.2)",
                                tension: 0.3
                            },
                            {
                                label: "Hogwarts Castle",
                                data: [120, 115, 117, 119, 123, 127, 130],
                                borderColor: "rgba(54, 162, 235, 1)",
                                backgroundColor: "rgba(54, 162, 235, 0.2)",
                                tension: 0.3
                            }
                        ]
                    };


                    const config = {
                        type: 'line',
                        data: legoSetData,
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'LEGO Set Market Price Trends'
                                },
                                legend: {
                                    position: 'top',
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Month'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Price (USD)'
                                    },
                                    beginAtZero: false
                                }
                            }
                        }
                    };

                    // Render the chart
                    const ctx = document.getElementById('legoChart').getContext('2d');
                    new Chart(ctx, config);
                </script>

            </div>
            <div class="terminal-box home-container">
                <table>
                    <tr>
                        <th>Top Ranked News </th>
                        <th class="time">Type</th>
                        <th class="time">Time</th>
                    </tr>
                    <tr class="row">
                        <td class="news-title">LEGO Reports Stable Financial Results for H1 2023</td>
                        <td class="type">LN</td>
                        <td class="time">13:00</td>
                    </tr>
                    <tr class="row">
                        <td class="news-title">LEGO Pauses Recycled PET Bricks Initiative</td>
                        <td class="type">LN</td>
                        <td class="time">12:45</td>
                    </tr>
                    <tr class="row">
                        <td class="news-title">LEGO Expands into Emerging Markets with 50 New Stores</td>
                        <td class="type">LN</td>
                        <td class="time">11:30</td>
                    </tr>
                    <tr class="row">
                        <td class="news-title">LEGO Education Launches New SPIKE Robotics Kit</td>
                        <td class="type">LN</td>
                        <td class="time">10:50</td>
                    </tr>
                    <tr class="row">
                        <td class="news-title">LEGO-Disney Collaboration for 100th Anniversary Unveiled</td>
                        <td class="type">LN</td>
                        <td class="time">10:15</td>
                    </tr>
                    <tr class="row">
                        <td class="news-title">LEGO Reveals New AI-Powered Build Assist Tool</td>
                        <td class="type">LN</td>
                        <td class="time">09:55</td>
                    </tr>
                    <tr class="row">
                        <td class="news-title">LEGO Ninjago Movie Sequel Confirmed for 2024 Release</td>
                        <td class="type">LN</td>
                        <td class="time">09:30</td>
                    </tr>
                    <tr class="row">
                        <td class="news-title">LEGO Launches Eco-Friendly Packaging Initiative Globally</td>
                        <td class="type">LN</td>
                        <td class="time">09:10</td>
                    </tr>
                    <tr class="row">
                        <td class="news-title">LEGO Sees Surge in Adult Fans with New 'LEGO Icons' Series</td>
                        <td class="type">LN</td>
                        <td class="time">08:45</td>
                    </tr>
                </table>
            </div>
            
        </div>
        <div class="terminal-box">
            <h2>Lego Set &emsp; Price &emsp; Change &nbsp; Index</h2>
            
            <a href="/set-details" style="text-decoration: none; color: inherit;">
                <div class="top-set" href="/set-details">
                    <p class="top-set-name">Star Destroyer</p>
                    <p class="for-sale-price">$139,99</p>
                    <p class="positive-change">+0.42</p>
                    <p class="for-sale-price">1.2103</p>
                </div>
            </a>

            <a href="/set-details" style="text-decoration: none; color: inherit;">
                <div class="top-set">
                    <p class="top-set-name">Hogwarts Castle</p>
                    <p class="for-sale-price">$129.99</p>
                    <p class="negative-change">-0.18</p>
                    <p class="for-sale-price">1.8703</p>
                </div>
            </a>

            <a href="/set-details" style="text-decoration: none; color: inherit;">
                <div class="top-set">
                    <p class="top-set-name">Technic Bugatti</p>
                    <p class="for-sale-price">$349.99</p>
                    <p class="positive">+0.31</p>
                    <p class="for-sale-price">1.8933</p>
                </div>
            </a>

            <a href="/set-details" style="text-decoration: none; color: inherit;">
                <div class="top-set">
                    <p class="top-set-name">Millennium Falcon</p>
                    <p class="for-sale-price">$799.99</p>
                    <p class="positive-change">+0.50</p>
                    <p class="for-sale-price">1.1671</p>
                </div>
            </a>
            
            <a href="/set-details" style="text-decoration: none; color: inherit;">
                <div class="top-set">
                    <p class="top-set-name">City Police HQ</p>
                    <p class="for-sale-price">$99,99</p>
                    <p class="negative-change">-0.26</p>
                    <p class="for-sale-price">1.0108</p>
                </div>
            </a>

            <a href="/set-details" style="text-decoration: none; color: inherit;">
                <div class="top-set">
                    <p class="top-set-name">City Police HQ</p>
                    <p class="for-sale-price">$99,99</p>
                    <p class="negative-change">-0.26</p>
                    <p class="for-sale-price">1.0108</p>
                </div>
            </a>
            <a href="/set-details" style="text-decoration: none; color: inherit;">
                <div class="top-set">
                    <p class="top-set-name">City Police HQ</p>
                    <p class="for-sale-price">$99,99</p>
                    <p class="negative-change">-0.26</p>
                    <p class="for-sale-price">1.0108</p>
                </div>
            </a>

            <a href="/set-details" style="text-decoration: none; color: inherit;">
                <div class="top-set">
                    <p class="top-set-name">City Police HQ</p>
                    <p class="for-sale-price">$99,99</p>
                    <p class="negative-change">-0.26</p>
                    <p class="for-sale-price">1.0108</p>
                </div>
            </a>

            <a href="/set-details" style="text-decoration: none; color: inherit;">
                <div class="top-set">
                    <p class="top-set-name">City Police HQ</p>
                    <p class="for-sale-price">$99,99</p>
                    <p class="negative-change">-0.26</p>
                    <p class="for-sale-price">1.0108</p>
                </div>
            </a>
        </div>
    </div>
</body>
</html>