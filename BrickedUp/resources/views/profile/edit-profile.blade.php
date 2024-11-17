<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Update Profile Information</title>
</head>
<body>
    
    @include('components.navbar', ['currentPage' => 'settings'])

    <h1>Update Profile Information</h1>

    <div class="settings-container">

        <form class="terminal-box-edit" method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="settings-row">
                <h3>New Username:</h3>
                <input type="text" name="name" id="name" value="{{auth()->user()->name}}">
            </div>

            <div class="settings-row">
                <h3>New Email: </h3>
                <input type="email" name="email" id="email" value="{{auth()->user()->email}}">
            </div>
            <button type="submit"><p class="fake-link">Update Username and Email</p></button>
        </form>
        <form class="terminal-box-edit" method="post" action="{{route('password.update')}}">
            @csrf
            @method('put')
            
            <div class="settings-row">
                <h3>Current Password: </h3>
                <input type="password" name="current_password" id="update_password_current_password" placeholder="Current Password">
            </div>
            <div class="settings-row">
                <h3>New Password:</h3>
                <input type="password" name="password" id="update_password_password" placeholder="New Password">
            </div>
            <div class="settings-row">
                <h3>Confirm Password:</h3>
                <input type="password" name="password_confirmation" id="update_password_password_confirmation" placeholder="Confirm Password">
            </div>
            <button type="submit"><p class="fake-link">Update Password</p></button>
        </form>

        <a style="margin-top: 2rem" href="/settings">Go back to settings</a>
    </div>
</body>
</html>