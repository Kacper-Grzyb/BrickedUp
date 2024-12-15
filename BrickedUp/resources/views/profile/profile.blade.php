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
            <div class="set-container">
                @foreach ($sets as $set)
                <div class="profile-box set-item">
                        <img src="data:image/png;base64,{{ $set->setImage->first()->image_data }}" style="height: 200px; width: 200px " alt="Set Image">
                        <h3>{{ $set['set_name'] }}</h3>
                        <p>Set Number: {{ $set['set_number'] }}</p>
                    </div>
                @endforeach
            </div>

            </div>
            
        </div>
    </div>
</body>
</html>