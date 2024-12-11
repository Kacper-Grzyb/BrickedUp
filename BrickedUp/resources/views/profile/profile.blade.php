<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>{{auth()->user()->name}} Profile</title>
</head>
<body>
    <x-navbar :currentPage='"profile"'/>

    <h1>Welcome {{auth()->user()->name}}</h1>
    <div class="profile-container">
        <div class="terminal-box profile-left-box">
            <img src="{{asset('img/chuj.webp')}}" width="200" height="200" style="border-radius: 3px;" alt="profile-picture">
            <div class="profile-username">
                Username: {{auth()->user()->name}}
            </div>

        </div>

        <div class="profile-subcontainer">

            
            <div class="terminal-box">
                User Inventory <br/>
                User Inventory
            </div>
            <div class="terminal-box">
                User Reviews
            </div>
        </div>
    </div>
</body>
</html>