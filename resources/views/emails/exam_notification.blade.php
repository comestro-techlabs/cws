<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Exam Available</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <header style="background: #4caf50; color: #fff; text-align: center; padding: 20px;">
            <h1 style="margin: 0;">📘 New Exam Available!</h1>
        </header>
        <main style="padding: 20px; color: #333;">
            <p>Dear {{ $user->name }},</p>
            <p>We’re excited to inform you that a new exam has been added to your course: <strong>{{ $exam->exam_name }}</strong>.</p>
            <p>📅 Make sure to check it out and give your best effort!</p>
        </main>
        <footer style="background: #f1f1f1; text-align: center; padding: 10px; font-size: 14px; color: #888;">
            <p>Thank you for learning with us!</p>
        </footer>
    </div>
</body>
</html>
