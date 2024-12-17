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
        <x-dashboard-theme-marketshare :sets='$sets' :style='$themeMarketshareStyle'/>
        <x-dashboard-set-price-table :setPrices='$setPrices' :displayAmount='20' :style='$setPriceTableStyle'/>
        <x-dashboard-set-prices :style='$setPricesStyle' :favouriteSetPriceRecords='$favouriteSetPriceRecords'/>
        <x-dashboard-theme-prices :style='$themePricesStyle' :favouriteThemeValues='$favouriteThemeValues'/>
        <x-dashboard-subtheme-prices :style='$subthemePricesStyle' :favouriteSubthemeValues='$favouriteSubthemeValues'/>

    </div>
</body>
</html>