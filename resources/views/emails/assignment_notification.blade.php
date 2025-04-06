<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Assignment Notification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            <div style="display: flex; align-items: center; margin-bottom: 25px;">
                <h2 style="font-size: 20px; font-weight: 500; margin: 0; color: rgb(165, 121, 207);">New Assignment Available</h2>
            </div>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                Hello <strong>{{ $user->name }}</strong>,
            </p>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                A new assignment has been added to your course <strong>{{ $assignment->course->title }}</strong>.
            </p>
            
            <!-- Assignment Details Box -->
            <div style="background-color: #f8f9fa; padding: 20px; margin: 25px 0; border-radius: 8px; border-left: 4px solid rgb(111, 57, 160);">
                <div style="font-size: 16px; font-weight: 500; color: rgb(111, 57, 160); margin-bottom: 15px;">Assignment Details</div>
                
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: 500; color: #5f6368;">Title:</span>
                    <span style="color: #5f6368;">{{ $assignment->title }}</span>
                </div>
                
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: 500; color: #5f6368;">Description:</span>
                    <span style="color: #5f6368;">{{ $assignment->description }}</span>
                </div>
                
                <div>
                    <span style="font-weight: 500; color: #5f6368;">Due Date:</span>
                    <span style="color: #5f6368;">{{ $assignment->due_date ?? 'No due date specified' }}</span>
                </div> 
            </div>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                Please log in to your account to view and complete the assignment.
            </p>
            
            <!-- CTA Button -->
            <div style="text-align: center; margin: 35px 0 25px;">
                <a href="{{ route('student.assignments-view') }}  " style="display: inline-block; background-color: rgb(111, 57, 160); color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 6px; font-size: 15px; font-weight: 500; letter-spacing: 0.2px;">
                    View Assignment
                </a>
            </div>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                Best regards,<br>
                <strong>Learn Syntax Team</strong>
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