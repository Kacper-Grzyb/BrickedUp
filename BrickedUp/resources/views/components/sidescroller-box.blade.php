<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sidescroller Box</title>
</head>
<body>
    <a href="/set-details/{{$set->set_number}}" style="text-decoration: none; color: inherit;"> 
        <li class="sidescroller-box">
            @if ($change > 0)
                <div class="sidescroller-box-status-green"></div>
            @else 
                <div class="sidescroller-box-status-red"></div>
            @endif
            <div class="sidescroller-box-content">
                <h6>{{$set->set_number}}</h6>
                @if($change > 0) 
                    <p class="positive-price">+{{$change}}%</p>
                @else 
                    <p class="negative-price">{{$change}}%</p> 
                @endif
            </div>
        </li>
    </a>
</body>
</html>