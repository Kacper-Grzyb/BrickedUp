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
            Available Charts
            <div id="draggable" draggable="true"></div>
        </div>
        <div class="terminal-box edit-grid" id="dashboard-grid" draggable="false">
            {{-- Grid is being displayed here --}}
            @for($r = 0; $r < 5; $r++)
                @for($c = 0; $c < 10; $c++)
                    <div class="grid-item" id="{{$r}}-{{$c}}" draggable="false"></div>
                @endfor
            @endfor
            
        </div>
    </div>

    <script src="{{asset('js/edit-dashboard.js')}}"></script>
</body>
</html>