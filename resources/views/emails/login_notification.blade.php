<!DOCTYPE html>
<html>
    <meta charset=" UTF-8">
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
<body>
    <p>Hello {{ $user->name }},</p>

    <p>We noticed a new login to your account:</p>

    <ul>
        <li><strong>IP Address:</strong> {{ $ip }}</li>
        <li><strong>City:</strong> {{ $location->cityName ?? 'Unknown' }}</li>
        <li><strong>>Region:</strong> {{ $location->regionName ?? 'Unknown'  }}</li>
        <li><strong>Country:</strong> {{ $location->countryName ?? 'Unknown' }}</li>
        <li><strong>Browser:</strong> {{ $browser }}</li>
        <li><strong>Time:</strong>{{ now()->format('Y-m-d H:i:s')}}</li>
    </ul>

    <p>If this wasn't you, please secure your account immediately.</p>

    <p>Regards,<br>Boot Skill Security Team</p>
</body>
</html>