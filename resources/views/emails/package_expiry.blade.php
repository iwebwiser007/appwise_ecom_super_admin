<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Expiry Reminder</title>
</head>

<body>
    @if ($reminderType === 'before_expiry')
    <h1>Your Package is Expiring Soon</h1>
    @elseif ($reminderType === 'expired')
    <h1>Your Package is Expired</h1>
    @endif
    <p>Dear {{ $name }},</p>
    @if ($reminderType === 'before_expiry')
    <p>This is a reminder that your package with ID <strong>{{ $package_id }}</strong> is about to expire in {{ ceil($remainingDays) }} days.</p>

    <p><strong>Package Details:</strong></p>
    <ul>
        <li><strong>Package Name:</strong> {{ $packageDetail->package_name }}</li>
        <li><strong>Expiry Date:</strong> @php
            $expiryDate = now()->addDays($packageDetail->days)->format('Y-m-d');
            @endphp
            {{ $expiryDate }}
        </li>

        <li><strong>Price:</strong> ${{ $packageDetail->price }}</li>
    </ul>

    <p>Please take action before the expiry date to avoid any interruptions in your service.</p>

    @elseif ($reminderType === 'expired')

    <p>We would like to inform you that your package with ID <strong>{{ $package_id }}</strong> has expired.</p>
    <p>Package Details:</p>
    <ul>
        <li><strong>Package Name:</strong> {{ $packageDetail->package_name }}</li>
        <li><strong>Expiry Date:</strong> {{ $packageDetail->end_date }}</li>
        <li><strong>Price:</strong> ${{ $packageDetail->price }}</li>
    </ul>
    <p>Your package is no longer active. Please contact us for further assistance.</p>
    @endif

    <p>Thank you!</p>
</body>



</html>


