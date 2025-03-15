<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f6f9fc; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
        <!-- Header with Gradient -->
        <header style="background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%); color: #ffffff; text-align: center; padding: 30px 20px;">
            <h1 style="margin: 0; font-size: 28px; font-weight: 700; letter-spacing: 0.5px;">Welcome to Learn Syntax!</h1>
            <div style="margin-top: 15px; font-size: 16px;">Your registration was successful</div>
        </header>

        <!-- Main Content -->
        <main style="padding: 30px; color: #333333;">
            <p style="font-size: 16px; line-height: 1.6; color: #4B5563;">
                Hi <strong>{{ $user->name }}</strong>,
            </p>
            
            <div style="background-color: #EEF2FF; padding: 20px; margin: 25px 0; border-radius: 8px; text-align: center;">
                <div style="font-size: 24px; margin-bottom: 10px;">🎉</div>
                <div style="font-size: 18px; font-weight: 600; color: #4F46E5; margin-bottom: 5px;">Your account is ready!</div>
                <p style="margin: 0; color: #6B7280;">You now have access to our platform</p>
            </div>
            
            
            
            <p style="font-size: 16px; line-height: 1.6; color: #4B5563;">
                If you have any questions, our support team is ready to help.
            </p>
            
            <p style="font-size: 16px; line-height: 1.6; color: #4B5563;">
                We're excited to have you on board!
            </p>
            
            <p style="font-size: 16px; line-height: 1.6; color: #4B5563; margin-top: 25px;">
                Best regards,<br>
                <strong>Learn Syntax Team</strong>
            </p>
        </main>
        
        
        <!-- Footer -->
        <footer style="background-color: #F3F4F6; padding: 20px; text-align: center; font-size: 14px; color: #6B7280;">
            <p style="margin: 0;">© {{ date('Y') }} Learn Syntax Connect. All rights reserved.</p>
           
        </footer>
    </div>
</body>
</html>