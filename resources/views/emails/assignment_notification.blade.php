<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Assignment Notification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f6f9fc; margin: 0; padding: 0; color: #333; line-height: 1.6;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
        <!-- Header with Gradient -->
        <header style="background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%); color: #ffffff; text-align: center; padding: 30px 20px;">
            <h1 style="margin: 0; font-size: 28px; font-weight: 700; letter-spacing: 0.5px;">New Assignment Available</h1>
            <div style="margin-top: 15px; font-size: 16px;">Your course has been updated</div>
        </header>
        
        <!-- Main Content -->
        <main style="padding: 30px; color: #333333;">
            <p style="font-size: 16px; line-height: 1.6; color: #4B5563;">
                Hello <strong>{{ $user->name }}</strong>,
            </p>
            
            <p style="font-size: 16px; line-height: 1.6; color: #4B5563;">
                A new assignment has been added to your course <strong>{{ $assignment->course->title }}</strong>.
            </p>
            
            <!-- Assignment Details Box -->
            <div style="background-color: #EEF2FF; padding: 20px; margin: 25px 0; border-radius: 8px;">
                <div style="font-size: 18px; font-weight: 600; color: #4F46E5; margin-bottom: 15px;">📄 Assignment Details</div>
                
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: 600; color: #4B5563;">Title:</span>
                    <span style="color: #4B5563;">{{ $assignment->title }}</span>
                </div>
                
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: 600; color: #4B5563;">Description:</span>
                    <span style="color: #4B5563;">{{ $assignment->description }}</span>
                </div>
                
                {{-- <div>
                    <span style="font-weight: 600; color: #4B5563;">Due Date:</span>
                    <span style="color: #4B5563;">{{ $assignment->due_date ?? 'No due date specified' }}</span>
                </div> --}}
            </div>
            
            <p style="font-size: 16px; line-height: 1.6; color: #4B5563;">
                 Please log in to your account to view and complete the assignment.
            </p>
            
            <!-- CTA Button -->
            <div style="text-align: center; margin: 30px 0 20px;">
                <a href="{{ route('student.assignment-upload', $assignment->id) }}" style="display: inline-block; background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%); color: #ffffff; text-decoration: none; padding: 12px 32px; border-radius: 6px; font-size: 16px; font-weight: 600; letter-spacing: 0.3px; transition: all 0.2s ease; box-shadow: 0 4px 10px rgba(107, 114, 128, 0.2);">
                    View Assignment
                </a>
            </div>
            
            <p style="font-size: 16px; line-height: 1.6; color: #4B5563; margin-top: 25px;">
                Best regards,<br>
                <strong>Learn Syntax Team</strong>
            </p>
        </main>
        
        <!-- Footer -->
        <footer style="background-color: #F3F4F6; padding: 20px; text-align: center; border-top: 1px solid #E5E7EB;">
            <p style="margin: 0; color: #6B7280; font-size: 14px;">© {{ date('Y') }} Learn Syntax. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>