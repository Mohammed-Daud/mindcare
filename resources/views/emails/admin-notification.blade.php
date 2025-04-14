<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Professional Application</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e3e6f0;
        }
        th {
            background-color: #f8f9fc;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Professional Application</h1>
    </div>
    
    <div class="content">
        <p>Hello Admin,</p>
        
        <p>A new professional has applied to join MindCare Professional Counseling. Please review their application details below:</p>
        
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $professional->first_name }} {{ $professional->last_name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $professional->email }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $professional->phone ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td>Specialization</td>
                <td>{{ $professional->specialization ?? 'Not specified' }}</td>
            </tr>
            <tr>
                <td>Qualification</td>
                <td>{{ $professional->qualification ?? 'Not specified' }}</td>
            </tr>
            <tr>
                <td>License Number</td>
                <td>{{ $professional->license_number ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td>License Expiry Date</td>
                <td>{{ $professional->license_expiry_date ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td>Application Date</td>
                <td>{{ $professional->created_at->format('F j, Y') }}</td>
            </tr>
        </table>
        
        <p>Please log in to the admin panel to review this application and take appropriate action.</p>
        
        <a href="{{ url('/admin/professionals') }}" class="button">View Application</a>
        
        <p>Best regards,<br>MindCare System</p>
    </div>
    
    <div class="footer">
        <p>This is an automated email from the MindCare Professional Counseling system.</p>
    </div>
</body>
</html> 