<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Assignment Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0;">
    <div style="background-color: #ffffff; border-radius: 8px; overflow: hidden; max-width: 600px; margin: 20px auto; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <header style="background-color: #4CAF50; color: #ffffff; text-align: center; padding: 20px;">
            <h1 style="margin: 0; font-size: 24px;">📚 New Assignment Available</h1>
        </header>
        <main style="padding: 20px; color: #333333; margin-bottom: 20px;">
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                Hello <strong>{{ $user->name }}</strong>,
            </p>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                A new assignment has been added to your course <strong>{{ $assignment->course->name }}</strong>.
            </p>
            <div style="margin: 20px 0; padding: 15px; border: 1px solid #dddddd; border-radius: 5px; background-color: #f9f9f9;">
                <h2 style="font-size: 18px; margin-bottom: 10px; color: #4CAF50;">📄 Assignment Details:</h2>
                <p style="margin: 5px 0; font-size: 16px;"><strong>Title:</strong> {{ $assignment->title }}</p>
                <p style="margin: 5px 0; font-size: 16px;"><strong>Description:</strong> {{ $assignment->description }}</p>
                {{-- <p style="margin: 5px 0; font-size: 16px;"><strong>Due Date:</strong> {{ $assignment->due_date ?? 'No due date specified' }}</p> --}}
            </div>
            <p style="font-size: 16px; line-height: 1.5; color: #555555;">
                📝 Please log in to your account to view and complete the assignment.
            </p>
            <a href="{{ route('student.assignment-upload', $assignment->id) }}" style="display: inline-block; background-color: #4CAF50; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 16px; margin-top: 10px;">
                View Assignment
            </a>
        </main>
        <footer style="background-color: #f4f4f9; padding: 15px; text-align: center; border-top: 1px solid #dddddd; font-size: 14px; color: #888888;">
            <p style="margin: 0;">🌟 Thank you for your dedication! 🌟</p>
            <p style="margin: 5px 0;">© {{ date('Y') }} Learn Syntax. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
