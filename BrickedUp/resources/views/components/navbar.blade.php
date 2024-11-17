<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Navbar</title>
    {{-- <style>
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
            min-width: 200px;
            height: auto;
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


    </style> --}}
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

                <li>
                    <img id="profile-dropdown-icon" src="{{asset('images/user_icon.svg')}}" alt="user icon">
                    <span class="arrow"></span>
                    <div class="profile-dropdown">
                        <h3>Logged in as: <span class="profile-name-span">{{auth()->user()->name}}</span></h3>
                        <a href="/chujciwdupe">Go to your profile</a>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log out') }}
                            </a>
                        </form>
                    </div>
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
    <script>
        let dropdownIcon = document.getElementById('profile-dropdown-icon');
        let dropdownButton = document.querySelector('.arrow');
        let profileDropdown = document.querySelector('.profile-dropdown');

        function toggleProfileDropdown() {
            if(profileDropdown.style.display === "none") {
                profileDropdown.style.display = "flex";
                dropdownIcon.src="{{asset('images/user_icon_highlighted.svg')}}";
                dropdownButton.style.transform = "rotate(225deg)";
            }
            else {
                profileDropdown.style.display = "none";
                dropdownIcon.src="{{asset('images/user_icon.svg')}}";
                dropdownButton.style.transform = "rotate(45deg)";
            }
        }

        dropdownIcon.addEventListener('click', () => toggleProfileDropdown());
        dropdownButton.addEventListener('click', () => toggleProfileDropdown());

        document.addEventListener('click', (e) => {
            if(!profileDropdown.contains(e.target) && !dropdownIcon.contains(e.target) && !dropdownButton.contains(e.target)) {
                profileDropdown.style.display = "none";
                dropdownIcon.src="{{asset('images/user_icon.svg')}}";
                dropdownButton.style.transform = "rotate(45deg)";
            }
        });

    </script>
</body>

</html>