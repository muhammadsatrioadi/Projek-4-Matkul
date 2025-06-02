<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Receipt</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header { 
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
        }
        .logo { 
            width: 150px;
            margin-bottom: 15px;
        }
        .title { 
            font-size: 28pt;
            font-weight: bold;
            margin: 20px 0;
            color: #2E7D32;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .info-section { 
            margin: 25px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .info-section h3 {
            color: #2E7D32;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .label { 
            font-weight: bold;
            color: #2E7D32;
            display: inline-block;
            width: 150px;
        }
        .footer { 
            margin-top: 50px;
            text-align: center;
            font-size: 10pt;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
        }
        .important { 
            color: #D32F2F;
            font-weight: bold;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        ul li {
            margin: 10px 0;
            padding-left: 25px;
            position: relative;
        }
        ul li:before {
            content: "✓";
            color: #4CAF50;
            position: absolute;
            left: 0;
        }
        .status-success {
            color: #4CAF50;
            font-weight: bold;
        }
        .amount {
            font-size: 16pt;
            color: #2E7D32;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="color: #2E7D32; font-size: 36pt; margin-bottom: 10px;">HealthNav</h1>
        <div class="title">Payment Receipt</div>
    </div>

    <div class="info-section">
        <h3>Payment Information</h3>
        <p><span class="label">Transaction ID:</span> {{ $payment->transaction_id }}</p>
        <p><span class="label">Date:</span> {{ $payment->created_at->format('F d, Y H:i:s') }}</p>
        <p><span class="label">Payment Status:</span> <span class="status-success">{{ ucfirst($payment->status) }}</span></p>
        <p><span class="label">Amount Paid:</span> <span class="amount">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span></p>
    </div>

    <div class="info-section">
        <h3>MCU Appointment Details</h3>
        <p><span class="label">Hospital:</span> {{ $payment->mcuRegistration->hospital->name }}</p>
        <p><span class="label">Appointment Date:</span> {{ $payment->mcuRegistration->appointment_date->format('F d, Y') }}</p>
        <p><span class="label">Time Slot:</span> {{ $payment->mcuRegistration->time_slot }}</p>
        <p><span class="label">Package:</span> {{ $payment->mcuRegistration->package_name }}</p>
    </div>

    <div class="info-section">
        <h3>Important Notes</h3>
        <ul>
            <li>Please arrive 15 minutes before your appointment time</li>
            <li>Bring a valid ID and this receipt</li>
            <li>Fast for 8-12 hours before the examination</li>
            <li>Wear comfortable clothing</li>
        </ul>
    </div>

    <div class="footer">
        <p style="font-size: 12pt; color: #2E7D32; font-weight: bold;">HealthNav Medical Check-Up Services</p>
        <p>Contact: support@healthnav.com | Phone: (021) 555-0123</p>
        <p class="important">This is an official receipt. Please keep it for your records.</p>
    </div>
</body>
</html>