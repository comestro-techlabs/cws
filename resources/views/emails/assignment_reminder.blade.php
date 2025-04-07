<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder for assignment</title>
</head>
<body style="font-family: 'Roboto', Arial, sans-serif; margin: 0; padding: 0; color: #202124; line-height: 1.5; background-color: #f5f5f5;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 5px rgba(0,0,0,0.05);">
        <!-- Accent Bar -->
        <div style="height: 6px; background: linear-gradient(to right,rgb(111, 57, 160),rgb(242, 243, 246));"></div>
        
        <!-- Logo Area -->
        <div style="text-align: center; padding: 30px 20px 20px;">
        <img src="{{ config('app.url') }}/images/LearnSyntax.png" alt="Learn Syntax Logo" style="max-width: 150px; height: auto;" />
            </div>
        
        <!-- Main Content -->
        <div style="padding: 0 30px 30px;">
            <div style="display: flex; align-items: center; margin-bottom: 25px;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #e8f0fe; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                    <span style="color: rgb(111, 57, 160)">📝</span>
                </div>
                <h2 style="font-size: 20px; font-weight: 500; margin: 0; color:rgb(165, 121, 207);">Assignment due soon</h2>
            </div>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 20px;">
                Hello {{ $user->name }},
            </p>
            
            <p style="font-size: 15px; color: #5f6368; margin-bottom: 25px;">
                Assignment added to your course <strong style="color:rgb(111, 57, 160);">{{ $assignment->course->title }}</strong> is going to be due on <strong style="color:rgb(111, 57, 160);">{{ $assignment->due_date ?? 'No due date specified' }}</strong>.Please ignore if already submitted.
            </p>
            
            <!-- Assignment Details - Modern & Cool Style -->
            <div style="background: linear-gradient(145deg, #ffffff, #f5f7ff); border-radius: 12px; padding: 0; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(26, 115, 232, 0.08);">
                <!-- Header Bar -->
                <div style="background-color:rgb(111, 57, 160); padding: 15px 22px; border-radius: 12px 12px 0 0; display: flex; align-items: center;">
                    <div style="width: 24px; height: 24px; background-color: rgba(255, 255, 255, 0.2); border-radius: 6px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                        <span style="color: #ffffff; font-size: 12px; font-weight: bold;">🔍</span>
                    </div>
                    <p style="font-size: 16px; font-weight: 500; margin: 0; color: #ffffff;">Assignment Details</p>
                </div>
                
                <!-- Content -->
                <div style="padding: 22px;">
                    <div style="display: flex; margin-bottom: 15px; align-items: flex-start;">
                        <div style="font-size: 14px; font-weight: 500; color: #5f6368; width: 85px; padding-top: 2px;">Title:</div>
                        <div style="font-size: 15px; color: #202124; font-weight: 500; flex: 1;">{{ $assignment->title }}</div>
                    </div>
                    
                    <div style="height: 1px; background-color: #e8eaed; margin: 15px 0;"></div>
                    
                    <div style="display: flex; align-items: flex-start;">
                        <div style="font-size: 14px; font-weight: 500; color: #5f6368; width: 85px; padding-top: 2px;">Description:</div>
                        <div style="font-size: 15px; color: #202124; flex: 1;">{{ $assignment->description }}</div>
                    </div>
                </div>
            </div>
            
            <!-- CTA Button --> 
            <div style="text-align: center; margin: 35px 0 15px;">
                <a href="{{ route('student.assignments-view') }}" style="display: inline-block; background-color: rgb(111, 57, 160); color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 6px; font-size: 15px; font-weight: 500; letter-spacing: 0.2px;">
                    View Assignment
                </a>
            </div>
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