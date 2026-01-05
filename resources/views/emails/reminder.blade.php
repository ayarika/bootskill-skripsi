<!DOCTYPE html>
<html>
<head>
    <title>Meeting Reminder</title>
</head>
<body>
    <h2>Meeting Reminder</title>
    <p>Your bootcamp meeting "<strong>{{ $event->title }}</strong>" will begin at {{ \Carbon\Carbon::parse($event->start_time)->format('d M Y H:i') }}.</p>
    <p>Please be ready to join!</p>
</body>
</html>