<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Login OTP</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0;">
    <div style=" background-color: #ffffff; border-radius: 8px; overflow: hidden;">
        <header style="background-color: #4CAF50; color: #ffffff; text-align: center; padding: 20px;">
            <h1 style="margin: 0; font-size: 24px;">🔑 Your OTP Code</h1>
        </header>
        <main style="padding: 20px; color: #333333;">
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                Here’s your One-Time Password (OTP) to securely log in:
            </p>
            <div style="margin: 20px 0; font-size: 20px; font-weight: bold; color: #4CAF50;">
                🔒 <span style="font-size: 24px;">{{ $otp }}</span> 🔒
            </div>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                ⏳ This OTP is valid for <strong>5 minutes</strong>.
            </p>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                ❓ If you did not request this, please ignore this email. Your account is safe.
            </p>
        </main>
        <footer style="background-color: #f4f4f9; padding: 15px; text-align: center; border-top: 1px solid #dddddd; font-size: 14px; color: #888888;">
            <p style="margin: 0;">🌟 Thank you for trusting us! 🌟</p>
            <p style="margin: 5px 0;">© {{ date('Y') }} Comestro Connect innovate , Achieve. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>

