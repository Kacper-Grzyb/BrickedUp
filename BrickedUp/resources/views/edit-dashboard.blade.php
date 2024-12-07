<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/dashboard-grid.css')}}">
    <title>Edit Dashboard Layout</title>
</head>
<body>
    <x-navbar :currentPage='"edit-dashboard"'/>

    <div class="edit-layout-content">
        <div class="terminal-box toolbox">
            <h3 style="font-size:1rem">Available Charts</h3>
            <div class="toolbox-container" id="toolbox">
                {{-- <div id="draggable" draggable="true" class="toolbox-item"></div> --}}
            </div>
        </div>
        <div class="terminal-box edit-grid" id="dashboard-grid" draggable="false">
            {{-- Grid is being displayed here --}}
            <div id="draggable" draggable="true" class="grid-item" style="grid-area: 2 / 2 / 2 / 2;">
                <div class="resize-up"></div>
                <div class="horizontal-resize">
                    <div class="resize-right"></div>
                    <div class="resize-left"></div>
                </div>
                <div class="resize-down"></div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/edit-dashboard.js')}}"></script>
</body>
</html>