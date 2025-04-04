<!DOCTYPE html>
<html>
<head>
    <title>Subscription Notification</title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>

    @if($isExpired)
        <p>Your subscription has expired. Please renew your subscription to continue accessing our services.</p>
        <p>Click the button below to renew your subscription:</p>
        <a href="{{ route('student.subscriptions.plans') }}" style="background-color: #4CAF50; color: white; padding: 14px 20px; text-decoration: none; border-radius: 4px;">Renew Now</a>
    @else
        <p>Your subscription will expire in {{ $daysLeft }} days.</p>
        <p>To ensure uninterrupted access to our services, please renew your subscription before it expires.</p>
        <a href="{{ route('student.subscriptions.plans') }}" style="background-color: #4CAF50; color: white; padding: 14px 20px; text-decoration: none; border-radius: 4px;">Renew Now</a>
    @endif

    <p>If you have any questions, please don't hesitate to contact us.</p>
</body>
</html>
