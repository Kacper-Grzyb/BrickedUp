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

    <div class="settings-container">

        <div class="terminal-box">
            <div class="settings-row">
                <h3>Username:</h3>
                <p>Stefan</p>
            </div>
            <a href="kawaszlugbombakupa">Change Username</a>
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Password: </h3>
                <p>*********</p>
            </div>
            <a href="kawaszlugbombakupa">Change Password</a>
        </div>
        <div class="terminal-box">
            <div class="settings-row">
                <h3>Email: </h3>
                <p>stefan@hotmale.com</p>
            </div>
            <a href="kawaszlugbombakupa">Change Email</a>
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
                <a href="">Edit Favourite Sets ˅</a>
                <div class="settings-dropdown-content" id="favourite-sets">
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
                <a href="">Edit Favourite Themes ˅</a>
                <div class="settings-dropdown-content" id="favourite-sets">
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
                <a href="">Edit Favourite Subthemes ˅</a>
                <div class="settings-dropdown-content" id="favourite-sets">
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

    </div>
</body>
</html>