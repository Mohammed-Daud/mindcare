<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Application Has Been Approved</title>
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
            background-color: #4e73df;
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
        .button {
            display: inline-block;
            background-color: #4e73df;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .credentials {
            background-color: #e3e6f0;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Congratulations! Your Application Has Been Approved</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $professional->first_name }},</p>
        
        <p>We are pleased to inform you that your application to join MindCare Professional Counseling has been approved. We are excited to welcome you to our team of mental health professionals!</p>
        
        <p>Your account has been created, and you can now log in to the professional portal using the following credentials:</p>
        
        <div class="credentials">
            <p><strong>Email:</strong> {{ $professional->email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>
        
        <p><strong>Important:</strong> For security reasons, please change your password after your first login.</p>
        
        <p>You can access the professional portal by clicking the button below:</p>
        
        <a href="{{ url('/professional/login') }}" class="button">Access Professional Portal</a>
        
        <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
        
        <p>Welcome to the MindCare team!</p>
        
        <p>Best regards,<br>The MindCare Team</p>
    </div>
    
    <div class="footer">
        <p>This email was sent from MindCare Professional Counseling. Please do not reply to this email.</p>
    </div>
</body>
</html> 