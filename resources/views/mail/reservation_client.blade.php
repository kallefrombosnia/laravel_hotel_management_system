<!DOCTYPE html>
<html>
<head>
    <title>Hotel Laravel</title>
</head>
<body>
    <h1>Reservation</h1>

    <p>Hello {{$name}}, you ordered our hotel service.</p>

    <p>Arrival date: {{ $arrival_date }}</p>
    <p>Leave date: {{ $leave_date }} </p>
    <p>Hotel room type: {{$room_name}}</p>
    <p>That makes it total of {{ $total_days }} days @if($total_days > 3) and you get {{$discount}}% discount @endif .</p>
    <p>Total price: {{$total_price}}$ @if($total_days > 3) with discount @endif.</p>

    <p>Thank you for using our services.</p>
    
    <p>{{ $reservation_date }}</p>
</body>
</html>