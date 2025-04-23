<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 10px;
        }
        .receipt-details {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .receipt-details h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .detail-row {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        .detail-label {
            font-weight: bold;
            color: #666;
        }
        .total {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            font-size: 1.2em;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
        .discount {
            color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="MindCare Logo" class="logo">
        <h1>Appointment Receipt</h1>
        <p>Thank you for choosing MindCare Professional Counseling</p>
    </div>

    <div class="receipt-details">
        <h2>Appointment Details</h2>
        
        <div class="detail-row">
            <span class="detail-label">Appointment ID:</span>
            <span>#{{ $appointment->id }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Date:</span>
            <span>{{ $appointment->start_time->format('F j, Y') }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Time:</span>
            <span>{{ $appointment->start_time->format('g:i A') }} - {{ $appointment->end_time->format('g:i A') }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Professional:</span>
            <span>Dr. {{ $professional->first_name }} {{ $professional->last_name }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Specialization:</span>
            <span>{{ $professional->specialization }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Session Duration:</span>
            <span>{{ $appointment->end_time->diffInMinutes($appointment->start_time) }} minutes</span>
        </div>

        @if($appointment->coupon_code)
        <div class="detail-row">
            <span class="detail-label">Coupon Applied:</span>
            <span>{{ $appointment->coupon_code }}</span>
        </div>
        @endif

        <div class="total">
            <div class="detail-row">
                <span class="detail-label">Session Fee:</span>
                <span>₹{{ number_format($appointment->fee, 2) }}</span>
            </div>
            
            @if($appointment->discount_amount > 0)
            <div class="detail-row discount">
                <span class="detail-label">Discount:</span>
                <span>-₹{{ number_format($appointment->discount_amount, 2) }}</span>
            </div>
            @endif
            
            <div class="detail-row">
                <span class="detail-label">Total Amount:</span>
                <span>₹{{ number_format($appointment->fee - $appointment->discount_amount, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>This is an official receipt from MindCare Professional Counseling</p>
        <p>For any queries, please contact us at support@mindcare.com</p>
        <p>Thank you for trusting us with your mental health journey!</p>
    </div>
</body>
</html> 