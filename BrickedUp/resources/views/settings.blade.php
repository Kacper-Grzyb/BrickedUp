<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Settings</title>
</head>
<body>
    <x-navbar :currentPage='"settings"'/>

    <h1>Settings</h1>

    @if(session('status'))
        <div id="success-message" class="alert-message terminal-box success">
            <p>{{session('status')}}</p>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function () {
                    let message = document.getElementById('success-message');
                    if(message) {
                        message.style.transition = 'opacity 0.5s ease';
                        message.style.opacity = '0';
                        setTimeout(() => message.remove(), 500);
                     }
                }, 5000)
            })
        </script>
    @endif

    @if ($errors->userDeletion->any())
        <div id="error-message" class="alert-message terminal-box error">
            @foreach($errors->userDeletion->all() as $error)
                {{ $error }}
            @endforeach
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function () {
                    let message = document.getElementById('error-message');
                    if(message) {
                        message.style.transition = 'opacity 0.5s ease';
                        message.style.opacity = '0'
                        setTimeout(() => message.remove(), 500)
                    }
                }, 5000)
            })
        </script>
    @endif

    <div class="settings-container">
        
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Username:</h3>
                <p>{{auth()->user()->name}}</p>
            </div>
            <a href="/edit-profile">Change Username</a>
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Email: </h3>
                <p>{{auth()->user()->email}}</p>
            </div>
            <a href="/edit-profile">Change Email</a>
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Password: </h3>
                <p>******** </p>
            </div>
            <a href="/edit-profile">Change Password</a>
        </div>
        <div class="terminal-box">
            <a href="/edit-dashboard">Edit Dashboard Layout</a>
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Favourite Sets: </h3>
                <div class="settings-display-favourites">
                    @if(count($favouriteSetNames) > 0)
                        @for($i=0; $i < count($favouriteSetNames); $i++)
                            @if($i !== count($favouriteSetNames)-1)
                                <p>{{$favouriteSetNames[$i]->set_number}} {{$favouriteSetNames[$i]->set_name}} |</p>
                            @else
                                <p>{{$favouriteSetNames[$i]->set_number}} {{$favouriteSetNames[$i]->set_name}}</p>
                            @endif
                        @endfor
                    @else 
                        <p>No favourited sets... </p> 
                    @endif
                </div>
            </div>
            <a href="/favorite-sets" style="white-space: nowrap">Edit Favourite Sets</a>
            <!--
            OLD DROPDOWN MENU
            <div class="settings-dropdown">
                <p id="favouriteSetDropdownButton">Edit Favourite Sets ˅</p>
                <form method="POST" id="favouriteSets" class="settings-dropdown-content" action="{{ route('profile.update-favourite-sets') }}">
                    @csrf
                    @method('patch')

                    <div class="searchbar">
                        <button>
                            <img src="{{asset('images/search_icon.svg')}}" alt="search icon">
                        </button>
                        <input type="text" placeholder="Set number, name..." id="sets-checkbox-search" onkeyup="filterSetCheckboxes()">
                    </div>
                    <div class="settings-dropdown-records">
                        @foreach($sets as $set)
                            <div class="settings-dropdown-row">
                                <input type="checkbox" id="{{$set->set_number}}" name="set-checkbox[]" value="{{$set->set_number}}" {{$favouriteSets->contains('set_number', $set->set_number) ? 'checked' : ''}}>
                                <label for="set-checkbox[]">{{$set->set_number}} {{$set->set_name}}</label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit"><p class="fake-link">Save</p></button>
                </form>
            </div>
            -->
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Favourite Themes: </h3>
                <div class="settings-display-favourites">
                    @if(count($favouriteThemeNames) > 0)
                        @for($i=0; $i < count($favouriteThemeNames); $i++)
                            @if($i !== count($favouriteThemeNames)-1)
                                <p>{{$favouriteThemeNames[$i]->theme}} |</p>
                            @else
                                <p>{{$favouriteThemeNames[$i]->theme}}</p>
                            @endif
                        @endfor
                    @else 
                        <p>No favourited themes... </p> 
                    @endif
                </div>
            </div>
            <div class="settings-dropdown">
                <p id="favouriteThemesDropdownButton">Edit Favourite Themes ˅</p>
                <form method="POST" id="favouriteThemes" class="settings-dropdown-content" action="{{ route('profile.update-favourite-themes') }}">
                    @csrf
                    @method('patch')

                    <div class="searchbar">
                        <button>
                            <img src="{{asset('images/search_icon.svg')}}" alt="search icon">
                        </button>
                        <input type="text" placeholder="Theme name..." id="themes-checkbox-search" onkeyup="filterThemeCheckboxes()">
                    </div>
                    <div class="settings-dropdown-records">
                        @foreach($themes as $theme)
                            <div class="settings-dropdown-row">
                                <input type="checkbox" id="{{$theme->id}}" name="theme-checkbox[]" value="{{$theme->id}}" {{$favouriteThemes->contains('theme_id', $theme->id) ? 'checked' : ''}}>
                                <label for="theme-checkbox[]">{{$theme->theme}}</label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit"><p class="fake-link">Save</p></button>
                </form>
            </div>
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Favourite Subthemes: </h3>
                <div class="settings-display-favourites">
                    @if(count($favouriteSubthemeNames) > 0)
                        @for($i=0; $i < count($favouriteSubthemeNames); $i++)
                            @if($i !== count($favouriteSubthemeNames)-1)
                                <p>{{$favouriteSubthemeNames[$i]->subtheme . " |"}}</p>
                            @else
                                <p>{{$favouriteSubthemeNames[$i]->subtheme}}</p>
                            @endif
                        @endfor
                    @else 
                        <p>No favourited subthemes... </p>
                    @endif
                </div>
            </div>
            <div class="settings-dropdown">
                <p id="favouriteSubthemesDropdownButton">Edit Favourite Subthemes ˅</p>
                <form method="POST" id="favouriteSubthemes" class="settings-dropdown-content" action="{{ route('profile.update-favourite-subthemes') }}">
                    @csrf
                    @method('patch')

                    <div class="searchbar">
                        <button>
                            <img src="{{asset('images/search_icon.svg')}}" alt="search icon">
                        </button>
                        <input type="text" placeholder="Subtheme name..." id="subthemes-checkbox-search" onkeyup="filterSubthemeCheckboxes()">
                    </div>
                    <div class="settings-dropdown-records">
                        @foreach($subthemes as $subtheme)
                            <div class="settings-dropdown-row">
                                <input type="checkbox" id="{{$subtheme->id}}" name="subtheme-checkbox[]" value="{{$subtheme->id}}" {{$favouriteSubthemes->contains('subtheme_id', $subtheme->id) ? 'checked' : ''}}>
                                <label for="subtheme-checkbox[]">{{$subtheme->subtheme}}</label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit"><p class="fake-link">Save</p></button>
                </form>
            </div>
        </div>

        <div class="terminal-box">
            <button onclick="showDeletePopup()" type="button"><p class="fake-link" style="color:rgb(255, 67, 61); margin:0">Delete Account</p></button>
        </div>

        <div class="delete-popup">  
                <form class="delete-popup-content" method="post" action="{{route('profile.destroy')}}">
                    @csrf
                    @method('delete')
                    <h3>Are you sure you want to delete your account?</h3>
                    <div style="width:100%">
                        <label for="password">Input your password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="button-group">
                        <button type="submit"><span class="fake-link" style="color:rgb(255, 67, 61)">Delete Account</span></button>
                        <button id="cancelDeleteAccount" onclick="closeDeletePopup()" type="button"><span class="fake-link">Cancel</span></button>
                    </div>
                </form>
            <div class="delete-background"></div>
        </div>

    </div>

    <script>
        let favouriteSetsButton = document.getElementById("favouriteSetDropdownButton");
        let favouriteThemesButton = document.getElementById("favouriteThemesDropdownButton");
        let favouriteSubthemesButton = document.getElementById("favouriteSubthemesDropdownButton");
        let favouriteSetsDropdown = document.getElementById("favouriteSets");
        let favouriteThemesDropdown = document.getElementById("favouriteThemes");
        let favouriteSubthemesDropdown = document.getElementById("favouriteSubthemes");

        favouriteSetsButton.addEventListener('click', () => {
            if(favouriteSetsDropdown.style.display === "none") {
                favouriteSetsDropdown.style.display = "flex";
            }
            else {
                favouriteSetsDropdown.style.display = "none";
            }
        });

        favouriteThemesButton.addEventListener('click', () => {
            if(favouriteThemesDropdown.style.display === "none") {
                favouriteThemesDropdown.style.display = "flex";
            }
            else {
                favouriteThemesDropdown.style.display = "none";
            }
        });

        favouriteSubthemesButton.addEventListener('click', () => {
            if(favouriteSubthemesDropdown.style.display === "none") {
                favouriteSubthemesDropdown.style.display = "flex";
            }
            else {
                favouriteSubthemesDropdown.style.display = "none";
            }
        });

        // This can be made more complex in the future because now you can open multiple dropdowns at once
        document.addEventListener('click', (e) => {
            if(!favouriteSetsButton.contains(e.target) &&
               !favouriteSetsDropdown.contains(e.target) &&
               !favouriteThemesButton.contains(e.target) &&
               !favouriteThemesDropdown.contains(e.target) &&
               !favouriteSubthemesButton.contains(e.target) &&
               !favouriteSubthemesDropdown.contains(e.target)
            ) {
                favouriteSetsDropdown.style.display = "none";
                favouriteThemesDropdown.style.display = "none";
                favouriteSubthemesDropdown.style.display = "none";
            }
        });

        // Copied the scroll functions from GeeksForGeeks dont judge
        function disableScroll() {
            // Get the current page scroll position
            scrollTop =
                window.pageYOffset ||
                document.documentElement.scrollTop;
            scrollLeft =
                window.pageXOffset ||
                document.documentElement.scrollLeft,

                // if any scroll is attempted,
                // set this to the previous value
                window.onscroll = function () {
                    window.scrollTo(scrollLeft, scrollTop);
                };
        }

        function enableScroll() {
            window.onscroll = function () { };
        }

        let deletePopup = document.querySelector(".delete-popup");

        function showDeletePopup() 
        {
            deletePopup.style.display = "block";
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            disableScroll();
        }

        function closeDeletePopup() 
        {
            deletePopup.style.display = "none";
            enableScroll();
        }

        function filterSetCheckboxes() {
            const searchInput = document.getElementById('sets-checkbox-search').value.toLowerCase();
            const favouriteSets = document.getElementById('favouriteSets');
            const checkboxes = favouriteSets.querySelectorAll('.settings-dropdown-row')

            checkboxes.forEach(checkbox => {
                const label = checkbox.querySelector('label').textContent.toLowerCase();
                if(label.includes(searchInput)) {
                    checkbox.style.display= "flex";
                }
                else {
                    checkbox.style.display= "none";
                }
            })
        }

        function filterThemeCheckboxes() {
            const searchInput = document.getElementById('themes-checkbox-search').value.toLowerCase();
            const favouriteThemes = document.getElementById('favouriteThemes');
            const checkboxes = favouriteThemes.querySelectorAll('.settings-dropdown-row')

            checkboxes.forEach(checkbox => {
                const label = checkbox.querySelector('label').textContent.toLowerCase();
                if(label.includes(searchInput)) {
                    checkbox.style.display= "flex";
                }
                else {
                    checkbox.style.display= "none";
                }
            })
        }

        function filterSubthemeCheckboxes() {
            const searchInput = document.getElementById('subthemes-checkbox-search').value.toLowerCase();
            const favouriteSubthemes = document.getElementById('favouriteSubthemes');
            const checkboxes = favouriteSubthemes.querySelectorAll('.settings-dropdown-row')

            checkboxes.forEach(checkbox => {
                const label = checkbox.querySelector('label').textContent.toLowerCase();
                if(label.includes(searchInput)) {
                    checkbox.style.display= "flex";
                }
                else {
                    checkbox.style.display= "none";
                }
            })
        }
    </script>

</body>
</html>