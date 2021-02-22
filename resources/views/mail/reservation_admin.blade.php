<!DOCTYPE html>
<html>
<head>
    <title>Hotel Laravel</title>
</head>
<body>
    <h1>Reservation notice to reception</h1>

    <p>Date: {{ $reservation_date }}</p>
    <p>{{$name}} ordered our hotel service.</p>

    <p>Info:</p>

    <p>Arrival date: {{ $arrival_date }}</p>
    <p>Leave date: {{ $leave_date }} </p>
    <p>Hotel room type: {{$room_name}}</p>

    <p>That makes it total of {{ $total_days }} days @if($total_days > 3) and they got {{$discount}}% discount @endif .</p>

    <p>Total price: {{$total_price}}$ @if($total_days > 3) with discount @endif.</p>

    <p>User note: {{$note}}</p>
</body>
</html>