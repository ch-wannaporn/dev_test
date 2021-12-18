<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <title>Room Info</title>
</head>
<body>
    <div id="container">
        <div id="sidebar-container">
            <div id="room-label">
                <span id="room-id" class="sidebar-text-white">{{$roomId}}</span>
            </div>
        </div>
        <div id="main-container">
            <div id="topbar-container"></div>
        </div>
    </div>
</body>
</html>