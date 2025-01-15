<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0;">
    <div style="max-width: 600px; background-color: #ffffff; border: 1px solid #dddddd;  overflow: hidden; ">
        <header style="background-color: #4CAF50; color: #ffffff; text-align: center; padding: 20px;">
            <h1 style="margin: 0; font-size: 24px;">🎉 Welcome to Our Community! 🎉</h1>
        </header>
        <main style="padding: 20px; color: #333333;">
            <h2 style="font-size: 22px; margin-top: 0;">👋 Hello, {{ $user->name }}!</h2>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                🌟 Thank you for joining us! Your account has been successfully created, and we’re thrilled to have you on board.
            </p>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                💬 If you have any questions or need assistance, feel free to reach out to us anytime. We’re here to help you make the most of your experience.
            </p>
            <div style="text-align: center; margin: 20px 0;">
                <a href="{{route('public.index')}}" 
                   style="display: inline-block; padding: 12px 20px; background-color: #4CAF50; color: #ffffff; text-decoration: none; font-size: 16px; border-radius: 4px; transition: background-color 0.3s ease;">
                    Visit Our Website 🌐
                </a>
            </div>
        </main>
        <footer style="background-color: #f4f4f9; padding: 15px; text-align: center; border-top: 1px solid #dddddd; font-size: 14px; color: #888888;">
            <p style="margin: 0;">🤝 Best regards,</p>
            <p style="margin: 5px 0;"><strong>Comestro Connect innovate , Achieve</strong></p>
            <p style="margin: 5px 0; font-size: 12px;">© {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
