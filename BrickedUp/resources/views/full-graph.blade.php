<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>LEGO Set Comparison Chart</title>
    <link rel="stylesheet" href="{{ asset('css/full-graph.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
  </head>
  <body>
    <x-navbar :currentPage='"full-graph"'/>
    <div id="container">
      <div id="leftBlock">
        <h2>Select A Set To Display</h2>
        <div class="search-container">
          <input
            type="text"
            id="search-input-chart"
            placeholder="🔍 Search for set name/number..."
            onkeydown="handleKeyDown(event)"
          />
        </div>
        <div id="results"></div>
        <form id="lego-sets-form" class="my-form"></form>
      </div>
      <div id="chartWrapper" class="my-chartWrapper">
        <h1>LEGO Set Market Price Comparison</h1>
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
    <script>
        window.setsData = @json($sets);
    </script>
    <script src="{{ asset('js/full-graph.js') }}"></script>
  </body>
</html>
