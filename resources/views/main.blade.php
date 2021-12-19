<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <title>Room Info</title>
</head>
<body>
    <div id="container">
        <div id="sidebar-container">
            <div id="room-label">
                <span id="room-id" class="text-white">{{$roomId}}</span>
            </div>
            <span id="upcoming" class="text-white">Upcoming</span>
            <h1 id="today">
                <span class="text-white-fade">{{date('l')}}</span>
                <br/>
                <span class="text-white">{{date('d M')}}</span>
            </h1>
            <div id="sidebar-footer"></div>
            <ul id="upcoming-schedule">
                @foreach($todayBookings as $booking)
                <li>
                    <span class="font-time text-white-fade">{{date('G:i', strtotime($booking["startTime"]))}} - {{date('G:i', strtotime($booking["endTime"]))}}</span>
                    <br/>
                    <span class="font-activity text-white">{{$booking["title"]}}</span>
                </li>
                @endforeach
            </ul>
        </div>
        <div id="main-container">
            <div id="topbar-container">
                @if(str_contains(Request::url(), 'thisweek'))
                <a href="#" id="tab1" class="tab tab-active">THIS WEEK</a>
                @else
                <a href="{{route('thisweek', ['roomId'=>$roomId])}}" id="tab1" class="tab">THIS WEEK</a>
                @endif
                
                @if(str_contains(Request::url(), 'nextweek'))
                <a href="#" id="tab2" class="tab tab-active">NEXT WEEK</a>
                @else
                <a href="{{route('nextweek', ['roomId'=>$roomId])}}" id="tab2" class="tab">NEXT WEEK</a>
                @endif

                @if(str_contains(Request::url(), 'wholemonth'))
                <a href="#" id="tab3" class="tab tab-active">WHOLE MONTH</a>
                @else
                <a href="{{route('wholemonth', ['roomId'=>$roomId])}}" id="tab3" class="tab">WHOLE MONTH</a>
                @endif
            </div>
            <div id="timeline-container">
                <div id="timeline-line"></div>
                @if(str_contains(Request::url(), 'thisweek'))
                <div class="day-label">
                    <span class="day-label-text">{{date('D, d M', strtotime('this Sunday'))}}</span>
                </div>
                <ul class="daily-timeline-list">
                    @foreach($todayBookings as $booking)
                    <li>
                        <span class="font-time text-black-fade">{{date('G:i', strtotime($booking["startTime"]))}} - {{date('G:i', strtotime($booking["endTime"]))}}</span>
                        <br/>
                        <span class="font-activity text-black">{{$booking["title"]}}</span>
                    </li>
                    @endforeach
                </ul>
                @endif
                @if(str_contains(Request::url(), 'nextweek'))
                <div class="day-label">
                    <span class="day-label-text">{{date('D, d M', strtotime('+ 7 days'))}}</span>
                </div>
                <ul class="daily-timeline-list">
                    @foreach($nextWeekBookings as $booking)
                    @if(date('w', strtotime($booking["startTime"]))===date('w', strtotime('+7 days')))
                    <li>
                        <span class="font-time text-black-fade">{{date('G:i', strtotime($booking["startTime"]))}} - {{date('G:i', strtotime($booking["endTime"]))}}</span>
                        <br/>
                        <span class="font-activity text-black">{{$booking["title"]}}</span>
                    </li>
                    @endif
                    @endforeach
                </ul>
                @endif
                @if(str_contains(Request::url(), 'wholemonth'))
                <div class="day-label">
                    <span class="day-label-text">{{date('D, d M')}}</span>
                </div>
                <ul class="daily-timeline-list">
                    @foreach($todayBookings as $booking)
                    <li>
                        <span class="font-time text-black-fade">{{date('G:i', strtotime($booking["startTime"]))}} - {{date('G:i', strtotime($booking["endTime"]))}}</span>
                        <br/>
                        <span class="font-activity text-black">{{$booking["title"]}}</span>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</body>
</html>