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
                @foreach($dashboardElements as $element)
                <div draggable="true" class="toolbox-item modular-element" id="{{$element->name}}">
                    <p class="modular-element-name">{{$element->name}}</p>
                    <div class="resize-up" draggable="true"></div>
                    <div class="horizontal-resize">
                        <div class="resize-left" draggable="true"></div>
                        
                        <div class="resize-right" draggable="true"></div>
                    </div>
                    <div class="resize-down" draggable="true"></div>
                </div>
                @endforeach
 
            </div>
            <h4>Warning: Resizing this page will result in unexpected behavior</h4>
        </div>
        <div class="terminal-box edit-grid" id="dashboard-grid" draggable="false">
            {{-- Grid is being displayed here --}}
        </div>
    </div>
    <div class="bottom-controls">
        <form action="{{ route('dashboard.save-layout') }}" method="POST" id="saveLayoutForm" class="save-layout-form">
            @csrf
            <input type="hidden" name="dashboardLayout" id="saveLayoutFormInput">
            <button type="submit" class="fake-link">Save Current Layout</button>
        </form>
        <form action="{{ route('dashboard.reset-layout') }}" method="POST" id="resetLayoutForm" class="reset-layout-form">
            @csrf
            <button type="submit" class="fake-link">Reset Dashboard Layout</button>
        </form>
        <a href="/settings">Go back to Settings</a>
    </div>

    <script src="{{asset('js/edit-dashboard.js')}}"></script>
</body>
</html>