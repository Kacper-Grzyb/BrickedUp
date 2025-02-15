<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <x-navbar :currentPage='"notification"'/>

    <div class="notifications-container">
        <h1>Notifications</h1>

        @if($notifications->isEmpty())
            <p>No notifications available.</p>
        @else
            <div class="notification-list">
                @foreach($notifications as $notification)
                    <div class="notification-item {{ $notification->read ? 'read' : 'unread' }}">
                        <p>{{ $notification->message }}</p>
                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .notifications-container {
            padding: 20px;
        }

        .notification-list {
            margin-top: 20px;
        }

        .notification-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .notification-item.unread {
            font-weight: bold;
            color: rgb(251, 139, 30);
        }

        .notification-item.read {
            font-weight: normal;
        }
    </style>
</body>
</html>
