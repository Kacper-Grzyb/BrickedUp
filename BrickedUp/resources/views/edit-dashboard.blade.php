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
                <div draggable="true" class="toolbox-item modular-element" id="1">
                    <div class="resize-up" draggable="true"></div>
                    <div class="horizontal-resize">
                        <div class="resize-left" draggable="true"></div>
                        <div class="resize-right" draggable="true"></div>
                    </div>
                    <div class="resize-down" draggable="true"></div>
                </div>

                <div draggable="true" class="toolbox-item modular-element" id="2" style="background-color: red">
                    <div class="resize-up" draggable="true"></div>
                    <div class="horizontal-resize">
                        <div class="resize-left" draggable="true"></div>
                        <div class="resize-right" draggable="true"></div>
                    </div>
                    <div class="resize-down" draggable="true"></div>
                </div>

                <div draggable="true" class="toolbox-item modular-element" id="3" style="background-color: green">
                    <div class="resize-up" draggable="true"></div>
                    <div class="horizontal-resize">
                        <div class="resize-left" draggable="true"></div>
                        <div class="resize-right" draggable="true"></div>
                    </div>
                    <div class="resize-down" draggable="true"></div>
                </div>

                <div draggable="true" class="toolbox-item modular-element" id="4">
                    <div class="resize-up" draggable="true"></div>
                    <div class="horizontal-resize">
                        <div class="resize-left" draggable="true"></div>
                        <div class="resize-right" draggable="true"></div>
                    </div>
                    <div class="resize-down" draggable="true"></div>
                </div>
            </div>
            <h4>Warning: Resizing this page will result in unexpected behavior</h4>
        </div>
        <div class="terminal-box edit-grid" id="dashboard-grid" draggable="false">
            {{-- Grid is being displayed here --}}
        </div>
    </div>

    <script src="{{asset('js/edit-dashboard.js')}}"></script>
</body>
</html>