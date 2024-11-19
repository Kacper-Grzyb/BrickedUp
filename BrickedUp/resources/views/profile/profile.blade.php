<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{auth()->user()->name}} Profile</title>
</head>
<body>
    @include('components.navbar', ['currentPage' => 'profile'])

    <img src="{{asset('img/chuj.webp')}}" alt="">
    <h1>Welcome {{auth()->user()->name}}</h1>
    <div class="terminal-box">
        User Inventory
    </div>
    <div class="terminal-box">
        User Reviews
    </div>
</body>
</html>