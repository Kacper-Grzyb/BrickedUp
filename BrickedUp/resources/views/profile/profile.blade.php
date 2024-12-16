<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>{{auth()->user()->name}} Favourite Sets</title>
</head>
<body>
    <x-navbar :currentPage='"profile"'/>

    <h1>Welcome {{auth()->user()->name}}! <br>
        Manage Your Favourite Sets</h1>
    <div class="profile-container"> 
        <div class="terminal-box set-container">
            @foreach ($sets as $set)
                <div class="profile-box set-item" data-set-number="{{ $set->set_number }}">
                    @if (!empty( $set->setImage->first()->image_data ))
                        <img src="data:image/png;base64,{{ $set->setImage->first()->image_data }}" style="height: 200px; width: 200px " alt="Set Image">
                    @else
                        <p>No image available</p>
                    @endif
                    <div class="set-text-container">
                        <h3>{{ $set['set_name'] }}</h3>
                        <p>Set Number: {{ $set['set_number'] }}</p>
                    </div>

                    <button class="favorite-btn" data-action="add" style="{{ $set->is_favorite ? 'display:none;' : '' }}">+ Add to Favorites</button>
                    <button class="favorite-btn" data-action="remove" style="{{ !$set->is_favorite ? 'display:none;' : '' }}">- Remove from Favorites</button>

                </div>
            @endforeach
        </div>
    </div>
</body>

<script src="{{ asset('js/favorites.js') }}"></script>
</html>