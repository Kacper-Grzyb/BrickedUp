@php
    $unreadNotifications = false;
    
    if (Auth::check()) {
        $unreadNotifications = \App\Models\Notification::where('user_id', auth()->id())
                                            ->where('read', false)
                                            ->exists();
    }
@endphp

<div class="nav-header">
        <ul class="navbar">
            <div>
                <li>
                    <a href="/dashboard">
                        @if($currentPage === 'dashboard')
                        <img src="{{asset('img/dashboard_icon_highlighted.svg')}}" alt="dashboard icon">
                        @else
                        <img src="{{asset('img/dashboard_icon.svg')}}" alt="dashboard icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/full-graph">
                        @if($currentPage === 'full-graph')
                        <img src="{{asset('img/chart_icon_highlighted.svg')}}" alt="chart icon">
                        @else
                        <img src="{{asset('img/chart_icon.svg')}}" alt="chart icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/explore-view">
                        @if($currentPage === 'explore-view')
                        <img src="{{asset('img/explore_icon_highlighted.svg')}}" alt="explore icon">
                        @else
                        <img src="{{asset('img/explore_icon.svg')}}" alt="explore icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/settings">
                        @if($currentPage === 'settings')
                        <img src="{{asset('img/settings_icon_highlighted.svg')}}" alt="settings icon">
                        @else
                        <img src="{{asset('img/settings_icon.svg')}}" alt="settings icon">
                        @endif
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
                <li>
                    <a href="/upload-data">
                        @if($currentPage === 'upload-data')
                            <img src="{{asset('img/upload_icon_highlighted.svg')}}" alt="upload icon">
                        @else
                            <img src="{{asset('img/upload_icon.svg')}}" alt="upload icon">
                        @endif
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('notifications.index') }}">
                        @if($unreadNotifications)
                            <img src="{{ asset('img/bell_icon_highlighted.svg') }}" alt="notification icon">
                        @else
                            <img src="{{ asset('img/bell_icon.svg') }}" alt="notification icon">
                        @endif
                    </a>
                </li>
                <li>
                    @if($currentPage === 'profile')
                    <img id="profile-dropdown-icon" src="{{asset('img/user_icon_highlighted.svg')}}" alt="user icon">
                    @else
                    <img id="profile-dropdown-icon" src="{{asset('img/user_icon.svg')}}" alt="user icon">
                    @endif
                    <span class="arrow"></span>
                    <div class="profile-dropdown">
                        <h3>Logged in as: <span class="profile-name-span">{{auth()->user()->name}}</span></h3>
                        <!--<a href="/profile">Go to your profile</a>   -->
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

            <div class="search-menu">
                <div class="searchbar">
                    <button>
                        <img src="{{asset('img/search_icon.svg')}}" alt="search icon">
                    </button>
                    <input id="search-input" type="text" placeholder="Search for set...">
                </div>
                <div id="search-results" class="search-results"></div>
            </div>

        </ul>

        <ul id="sidescroller" class="set-prices-sidescroller">
            @foreach ($sets as $set)
            {{-- Change is random for now as there are no calculations of the set price records --}}
            <x-sidescroller-box :set=$set :change='$set->price_change ?? 0' />
            @endforeach
        </ul>

    </div>
    <script>
        let dropdownIcon = document.getElementById('profile-dropdown-icon');
        let dropdownButton = document.querySelector('.arrow');
        let profileDropdown = document.querySelector('.profile-dropdown');

        function toggleProfileDropdown() {
            if (profileDropdown.style.display === "none") {
                profileDropdown.style.display = "flex";
                dropdownIcon.src = "{{asset('img/user_icon_highlighted.svg')}}";
                dropdownButton.style.transform = "rotate(225deg)";
            } else {
                profileDropdown.style.display = "none";
                dropdownIcon.src = "{{asset('img/user_icon.svg')}}";
                dropdownButton.style.transform = "rotate(45deg)";
            }
        }


        dropdownIcon.addEventListener('click', () => toggleProfileDropdown());
        dropdownButton.addEventListener('click', () => toggleProfileDropdown());

        document.addEventListener('click', (e) => {
            if (!profileDropdown.contains(e.target) && !dropdownIcon.contains(e.target) && !dropdownButton.contains(e.target)) {
                profileDropdown.style.display = "none";
                dropdownIcon.src = "{{asset('img/user_icon.svg')}}";
                dropdownButton.style.transform = "rotate(45deg)";
            }
        });
    </script>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('js/searchbar.js') }}"></script>
    <script src="{{asset('js/sidescroller.js')}}"></script>