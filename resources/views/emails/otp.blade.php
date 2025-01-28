<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Login OTP</title>
</head>
<body style="background-color:#f4f4f9; padding: 15px; text-align: center; border-top: 1px solid #dddddd; font-size: 14px; color: #888888; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
    <div style="">
        <header style="">
            {{-- <h1 style="margin: 0; font-size: 28px; font-weight: bold;">Your OTP Code</h1> --}}
            <img src="https://learnsyntax.com/assets/LearnSyntax.png" alt="Learn Syntax" style="max-width: 200px; margin-top: 10px;">
        </header>
        <main style="padding: 20px; color: #333333;">
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                Dear {{$user->name}},
            </p>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                To complete your login process, here is your One-Time Password (OTP):
            </p>
            <div style="font-size: 24px; font-weight: bold; color: white;">
                <p style="font-size:20px; font-weight: bold; text-align: center; background-color: #662d91; color: white; padding: 5px; border-radius: 8px; width: 20%; margin: 20px auto;">
                    {{ $otp }}
                </p>            </div>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                 This OTP is valid for <strong>5 minutes</strong> only.
            </p>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                If you did not request this, please ignore this email. Your account remains secure.
            </p>
        </main>
        <footer style="background-color:#f4f4f9; padding: 20px;  text-align: center; border-top: 1px solid #dddddd; font-size: 14px; color: #888888; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            <p style="margin: 0; font-weight: bold; ">Learn Syntax</p>
            <p style="margin: 5px 0; "> Thank you for trusting us to secure your account! 🌟</p>
            <p style="margin: 5px 0; ">© {{ date('Y') }} Learn Syntax. All rights reserved.</p>
        </footer>
    </div>
    
</body>
</html>

