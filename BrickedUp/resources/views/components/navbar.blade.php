<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Navbar</title>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            color: white;
            min-width: 120px;
            border-radius: 4px;
            z-index: 1;
        }

        .dropdown-content a {
            color: white;
            padding: 8px 12px;
            display: block;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background-color: #555;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .arrow {
            display: inline-block;
            margin-left: 4px;
            margin-top: -12px;
            width: 6px;
            height: 6px;
            border-right: 2px solid #333;
            border-bottom: 2px solid #333;
            transform: rotate(45deg);
            vertical-align: middle;
        }

        .search-results {
            display: none;
            position: fixed;
            margin: 48px 8px 8px 8px;
            border: 1px solid rgb(118, 118, 118);
            border-radius: 5px;
            z-index: 1000;
        }

        .search-result {
            cursor: pointer;
            background-color: #333;
            padding: 8px 12px;
            border-bottom: 1px solid rgb(118, 118, 118);
        }

        .search-results:last-child {
            border-bottom: none;
        }

        .search-result:hover {
            background-color: #555;
        }

    </style>
</head>

<body>
    <div class="nav-header">
        <ul class="navbar">
            <div>
                <li>
                    <a href="/home">
                        @if($currentPage === 'home')
                            <img src="{{asset('images/home_icon_highlighted.svg')}}" alt="home icon">
                        @else
                            <img src="{{asset('images/home_icon.svg')}}" alt="home icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/full-graph">
                        @if($currentPage === 'full-graph')
                            <img src="{{asset('images/chart_icon_highlighted.svg')}}" alt="chart icon">
                        @else
                            <img src="{{asset('images/chart_icon.svg')}}" alt="chart icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/settings">
                        @if($currentPage === 'settings')
                            <img src="{{asset('images/settings_icon_highlighted.svg')}}" alt="settings icon">
                        @else
                            <img src="{{asset('images/settings_icon.svg')}}" alt="settings icon">
                        @endif
                    </a>
                </li>

                <li class="dropdown">
                    <img src="{{asset('images/user_icon.svg')}}" alt="user icon">
                    <span class="arrow"></span>
                    <div class="dropdown-content">
                        <a href="/settings">{{ __('Profile') }}</a>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </li>
            </div>
            <li>
                <div class="search-menu">
                    <div class="searchbar">
                        <button>
                            <img src="{{asset('images/search_icon.svg')}}" alt="search icon">
                        </button>
                        <input id="search-input" type="text" placeholder="Search for set...">
                    </div>
                    <div id="search-results" class="search-results"></div>
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
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('js/searchbar.js') }}"></script>
</body>

</html>