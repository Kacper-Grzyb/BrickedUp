<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{auth()->user()->name}} Profile</title>
</head>
<body>
    <x-navbar :currentPage='"profile"'/>

    <h1>Welcome {{auth()->user()->name}}! <br>
        This is your profile page</h1>
    
</body>
</html>