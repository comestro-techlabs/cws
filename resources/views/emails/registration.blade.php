<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0;">
    <div style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
        <header style="background-color: #4CAF50; color: #ffffff; text-align: center; padding: 20px;">
            <h1 style="margin: 0; font-size: 24px;">🎉 Registration Successful!</h1>
        </header>
        <main style="padding: 20px; color: #333333;">
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                Dear <strong>{{ $user->name }}</strong>,
            </p>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                Congratulations! Your account has been successfully created.
            </p>
            <div style="margin: 20px 0; font-size: 20px; font-weight: bold; color: #4CAF50;">
                ✨ Welcome to LearnSyntax Connect! ✨
            </div>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                You can now log in and start exploring our platform. If you have any questions or need assistance, feel free to reach out to our support team.
            </p>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                We're excited to have you on board!
            </p>
        </main>
        <footer style="background-color: #f4f4f9; padding: 15px; text-align: center; border-top: 1px solid #dddddd; font-size: 14px; color: #888888;">
            <p style="margin: 0;">🌟 Thank you for joining us! 🌟</p>
            <p style="margin: 5px 0;">© {{ date('Y') }} LearnSyntax Connect. Innovate, Achieve. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
