<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Application Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #dc3545;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            background-color: #f8f9fc;
            border: 1px solid #e3e6f0;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Application Status Update</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $professional->first_name }},</p>
        
        <p>Thank you for your interest in joining MindCare Professional Counseling. After careful review of your application, we regret to inform you that we are unable to proceed with your application at this time.</p>
        
        <p>While we appreciate your qualifications and experience, we have decided to move forward with other candidates whose profiles more closely match our current needs.</p>
        
        <p>We encourage you to:</p>
        <ul>
            <li>Update your qualifications and experience</li>
            <li>Ensure all required documents are current and valid</li>
            <li>Consider applying again in the future when we have new opportunities</li>
        </ul>
        
        <p>We wish you the very best in your professional endeavors.</p>
        
        <p>Best regards,<br>The MindCare Team</p>
    </div>
    
    <div class="footer">
        <p>This email was sent from MindCare Professional Counseling. Please do not reply to this email.</p>
    </div>
</body>
</html> 