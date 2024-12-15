<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Notifications</title>
</head>
<body>
    <x-navbar :currentPage='"notifications"'/>

    <div class="notifications-container">
        <h2>Your Notifications</h2>

        @if($notifications->isEmpty())
            <p>No notifications available.</p>
        @else
            <ul>
                @foreach($notifications as $notification)
                    <li class="{{ $notification->read ? 'read' : 'unread' }}">
                        {{ $notification->message }} - {{ $notification->created_at->diffForHumans() }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
