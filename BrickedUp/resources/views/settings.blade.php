<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Settings</title>
</head>
<body>
    
    @include('components.navbar', ['currentPage' => 'settings'])

    <h1>Settings</h1>

    @if(session('status'))
        <div id="success-message" class="alert-message terminal-box">
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
            <a href="kawaszlugbombakupa">Edit Dashboard Layout</a>
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Favourite Sets: </h3>
                <p>Display favourite sets here...</p>
            </div>
            <div class="settings-dropdown">
                <p id="favouriteSetDropdownButton">Edit Favourite Sets ˅</p>
                <div id="favouriteSets" class="settings-dropdown-content">
                    <div class="searchbar">
                        <button>
                            <img src="{{asset('images/search_icon.svg')}}" alt="search icon">
                        </button>
                        <input type="text" placeholder="Set number, name...">
                    </div>
                    <div class="settings-dropdown-row">
                        <input type="checkbox" id="12345" name="12345" value="SetName">
                        <label for="12345">Set Name</label>
                    </div>
                    <div class="settings-dropdown-row">
                        <input type="checkbox" id="12345" name="12345" value="SetName">
                        <label for="12345">Set Name</label>
                    </div>
                    <div class="settings-dropdown-row">
                        <input type="checkbox" id="12345" name="12345" value="SetName">
                        <label for="12345">Set Name</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Favourite Themes: </h3>
                <p>Display favourite themes here...</p>
            </div>
            <div class="settings-dropdown">
                <p id="favouriteThemesDropdownButton">Edit Favourite Themes ˅</p>
                <div id="favouriteThemes" class="settings-dropdown-content">
                    <div class="searchbar">
                        <button>
                            <img src="{{asset('images/search_icon.svg')}}" alt="search icon">
                        </button>
                        <input type="text" placeholder="Theme name...">
                    </div>
                    <div class="settings-dropdown-row">
                        <input type="checkbox" id="12345" name="12345" value="Theme">
                        <label for="12345">Theme</label>
                    </div>
                    <div class="settings-dropdown-row">
                        <input type="checkbox" id="12345" name="12345" value="Theme">
                        <label for="12345">Theme</label>
                    </div>
                    <div class="settings-dropdown-row">
                        <input type="checkbox" id="12345" name="12345" value="Theme">
                        <label for="12345">Theme</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Favourite Subthemes: </h3>
                <p>Display favourite subthemes here...</p>
            </div>
            <div class="settings-dropdown">
                <p id="favouriteSubthemesDropdownButton">Edit Favourite Subthemes ˅</p>
                <div id="favouriteSubthemes" class="settings-dropdown-content">
                    <div class="searchbar">
                        <button>
                            <img src="{{asset('images/search_icon.svg')}}" alt="search icon">
                        </button>
                        <input type="text" placeholder="Subtheme name...">
                    </div>
                    <div class="settings-dropdown-row">
                        <input type="checkbox" id="12345" name="12345" value="Subtheme">
                        <label for="12345">Subtheme</label>
                    </div>
                    <div class="settings-dropdown-row">
                        <input type="checkbox" id="12345" name="12345" value="Subtheme">
                        <label for="12345">Subtheme</label>
                    </div>
                    <div class="settings-dropdown-row">
                        <input type="checkbox" id="12345" name="12345" value="Subtheme">
                        <label for="12345">Subtheme</label>
                    </div>
                </div>
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

    </script>

</body>
</html>