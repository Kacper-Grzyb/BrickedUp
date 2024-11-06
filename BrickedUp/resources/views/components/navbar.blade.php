<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Navbar</title>
</head>
<body>
    <div class = "nav-header">
        <ul class="navbar">
            <div> {{--This is in a div so that the allignment is correct--}}
                <li>
                    <img src="{{asset('images/home_icon.svg')}}" alt="home icon">
                </li>
                <li>
                    <img src="{{asset('images/chart_icon.svg')}}" alt="chart icon">
                </li>
                <li>
                    <img src="{{asset('images/settings_icon_highlighted.svg')}}" alt="settings icon">
                </li>
                <li>
                    <img src="{{asset('images/user_icon.svg')}}" alt="user icon">
                </li>
            </div>
            <li>
                <div class="searchbar">
                    <button>
                        <img src="{{asset('images/search_icon.svg')}}" alt="search icon">
                    </button>
                    <input type="text" placeholder="Search for set...">
                </div>
            </li>
        </ul>
    
        <ul class="set-prices-sidescroller">
            @include('components.sidescroller-box')
            @include('components.sidescroller-box')
            @include('components.sidescroller-box')
            @include('components.sidescroller-box')
            @include('components.sidescroller-box')
            @include('components.sidescroller-box')
            @include('components.sidescroller-box')
            @include('components.sidescroller-box')
            @include('components.sidescroller-box')
            @include('components.sidescroller-box')
            
        </ul>
    </div>
</body>
</html>