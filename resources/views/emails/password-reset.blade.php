
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder for upcoming exam</title>
</head>
<body style="font-family: 'Roboto', Arial, sans-serif; margin: 0; padding: 0; color: #202124; line-height: 1.5; background-color: #f5f5f5;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 5px rgba(0,0,0,0.05);">
        <!-- Accent Bar -->
        <div style="height: 6px; background: linear-gradient(to right,rgb(111, 57, 160),rgb(242, 243, 246));"></div>
        
        <!-- Logo Area -->
        <div style="text-align: center; padding: 30px 20px 20px;">
        <img src="{{ config('app.url') }}/images/LearnSyntax.png" alt="Learn Syntax Logo" style="max-width: 150px; height: auto;" />
            </div>
        
        <!-- Main Content -->
        <div style="padding: 0 30px 30px;">
            <div style="display: flex; align-items: center; margin-bottom: 25px;">
                <h2 style="font-size: 20px; font-weight: 500; margin: 0; color:rgb(165, 121, 207);">Password Reset Request</h2>
            </div>
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
            We received a request to reset your password. Click the button below to create a new password
            </p>
            
           <!-- CTA Button -->
           <div style="text-align: center; margin: 35px 0 25px;">
                <a href="{{ url(config('app.url') . route('password.reset', ['token' => $token], false)) }}" style="display: inline-block; background-color: rgb(111, 57, 160); color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 6px; font-size: 15px; font-weight: 500; letter-spacing: 0.2px;">
                    Reset Password
                </a>
            </div>
             
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
            This link will expire in 60 minutes.
            If you did not request a password reset, please ignore this email or contact support if you have concerns about your account security.
            </p>
        </div>
        
        <!-- Footer -->
        <div style="padding: 20px 30px; background-color: #fafafa; border-top: 1px solid #f0f0f0; text-align: center;">
            <p style="font-size: 13px; color: #5f6368; margin: 0;">
                © {{ date('Y') }} Learn Syntax. All rights reserved.
            </p>
            <p style="font-size: 13px; color: #5f6368; margin: 0;">
                Gandhi Nagar, Madhubani, Purnia, Bihar 854301
            </p>
        </div>
    </div>
</body>
</html>