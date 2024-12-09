<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>BrickedUp - Home</title>
</head>

<body>
    <x-navbar :currentPage='"dashboard"'/>

    <div class="dashboard-content" style="align-items: start">
        <x-marketshare-chart :sets='$sets' :style="'grid-row: 1 / 4; grid-column: 1 / 5'"/>    
        <x-price-updates :setPrices='$setPrices' :style="'grid-row: 1 / 4; grid-column: 5 / 11'"/>
    </div>
</body>
</html>