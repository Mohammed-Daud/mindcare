<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to MindCare Professional Counseling</title>
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to MindCare Professional Counseling</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $professional->first_name }},</p>
        
        <p>Thank you for applying to join our team of mental health professionals at MindCare Professional Counseling. We have received your application and our team will review it shortly.</p>
        
        <p>Here's a summary of the information you provided:</p>
        <ul>
            <li><strong>Name:</strong> {{ $professional->first_name }} {{ $professional->last_name }}</li>
            <li><strong>Email:</strong> {{ $professional->email }}</li>
            <li><strong>Specialization:</strong> {{ $professional->specialization ?? 'Not specified' }}</li>
            <li><strong>Qualification:</strong> {{ $professional->qualification ?? 'Not specified' }}</li>
        </ul>
        
        <p>Our review process typically takes 2-3 business days. Once your application has been reviewed, you will receive an email with the outcome.</p>
        
        <p>If you have any questions or need to update your application, please don't hesitate to contact us.</p>
        
        <p>Best regards,<br>The MindCare Team</p>
    </div>
    
    <div class="footer">
        <p>This email was sent from MindCare Professional Counseling. Please do not reply to this email.</p>
    </div>
</body>
</html> 