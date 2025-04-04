<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body style="font-family: 'Roboto', Arial, sans-serif; margin: 0; padding: 0; color: #202124; line-height: 1.5; background-color: #f5f5f5;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 5px rgba(0,0,0,0.05);">
        
        <!-- Accent Bar -->
        <div style="height: 6px; background: linear-gradient(to right, rgb(111, 57, 160), rgb(242, 243, 246));"></div>
        
        <!-- Logo Area -->
        <div style="text-align: center; padding: 30px 20px 20px;">
            <img src="{{ config('app.url') }}/images/LearnSyntax.png" alt="Learn Syntax Logo" style="max-width: 150px; height: auto;" />
        </div>
        
        <!-- Main Content -->
        <div style="padding: 0 30px 30px;">
            
            <!-- Icon + Title -->
            <div style="display: flex; align-items: center; margin-bottom: 25px;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #e8f0fe; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                    <span style="color: rgb(111, 57, 160); font-size: 22px;">🎉</span>
                </div>
                <h2 style="font-size: 20px; font-weight: 500; margin: 0; color: rgb(165, 121, 207);">Registration Successful</h2>
            </div>

            <!-- Greeting -->
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 20px;">
                Dear <strong>{{ $user->name }}</strong>,
            </p>

            <!-- Message -->
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                Congratulations! Your registration on <strong style="color:rgb(111, 57, 160);">Learn Syntax</strong> was successful. You now have access to our platform and learning resources.
            </p>

            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                Click the button below to explore your dashboard and get started with your learning journey.
            </p>

            <!-- CTA Button -->
            <div style="text-align: center; margin-bottom: 30px;">
                <a href="{{ url('/') }}" style="display: inline-block; padding: 12px 30px; font-size: 14px; font-weight: 600; color: #ffffff; background-color: rgb(111, 57, 160); text-decoration: none; border-radius: 5px; transition: background 0.3s;">
                    Go to Dashboard
                </a>
            </div>

            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                If you have any questions, feel free to reach out to our support team. We're excited to have you onboard!
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
            <p style="font-size: 13px; color: #5f6368; margin: 0;">
                Need help? <a href="mailto:info@Learnsyntax.com" style="color: rgb(111, 57, 160); text-decoration: none;">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html>
