<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .receipt-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }
        .receipt-number {
            color: #666;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 18px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .info-row {
            margin-bottom: 5px;
        }
        .label {
            font-weight: bold;
            color: #666;
            width: 150px;
            display: inline-block;
        }
        .value {
            color: #333;
        }
        .total-section {
            margin-top: 20px;
            border-top: 2px solid #ddd;
            padding-top: 10px;
        }
        .total-row {
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="receipt-title">Mt. Cagua Hiking</div>
        <div class="receipt-number">Receipt #{{ $payment->id }}</div>
        <div>{{ $payment->created_at->format('F d, Y') }}</div>
    </div>

    <div class="section">
        <div class="section-title">Customer Information</div>
        <div class="info-row">
            <span class="label">Name:</span>
            <span class="value">{{ $payment->booking->user->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Email:</span>
            <span class="value">{{ $payment->booking->user->email }}</span>
        </div>
        <div class="info-row">
            <span class="label">Contact Number:</span>
            <span class="value">{{ $payment->booking->user->contact_number }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Booking Details</div>
        <div class="info-row">
            <span class="label">Booking ID:</span>
            <span class="value">#{{ $payment->booking->id }}</span>
        </div>
        <div class="info-row">
            <span class="label">Hike Date:</span>
            <span class="value">{{ $payment->booking->hike->date->format('F d, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Start Time:</span>
            <span class="value">{{ $payment->booking->hike->start_time->format('h:i A') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Tourists:</span>
            <span class="value">
                @if($payment->booking->foreign_tourists > 0)
                    {{ $payment->booking->foreign_tourists }} Foreign
                @endif
                @if($payment->booking->local_tourists > 0)
                    {{ $payment->booking->local_tourists }} Local
                @endif
            </span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Payment Details</div>
        <div class="info-row">
            <span class="label">Payment Method:</span>
            <span class="value">{{ ucfirst($payment->payment_method) }}</span>
        </div>
        <div class="info-row">
            <span class="label">Transaction ID:</span>
            <span class="value">{{ $payment->transaction_id }}</span>
        </div>
        <div class="info-row">
            <span class="label">Payment Status:</span>
            <span class="value">{{ ucfirst($payment->status) }}</span>
        </div>
        <div class="info-row">
            <span class="label">Verified At:</span>
            <span class="value">{{ $payment->verified_at->format('F d, Y h:i A') }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Fee Breakdown</div>
        <div class="info-row">
            <span class="label">Hiking Fee:</span>
            <span class="value">₱{{ number_format($payment->booking->hiking_fee, 2) }}</span>
        </div>
        @if($payment->booking->guide_fee > 0)
        <div class="info-row">
            <span class="label">Guide Fee:</span>
            <span class="value">₱{{ number_format($payment->booking->guide_fee, 2) }}</span>
        </div>
        @endif
        @if($payment->booking->porter_fee > 0)
        <div class="info-row">
            <span class="label">Porter Fee:</span>
            <span class="value">₱{{ number_format($payment->booking->porter_fee, 2) }}</span>
        </div>
        @endif
        <div class="total-section">
            <div class="info-row total-row">
                <span class="label">Total Amount:</span>
                <span class="value">₱{{ number_format($payment->amount, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Thank you for choosing Mt. Cagua for your hiking adventure!</p>
        <p>For any inquiries, please contact us at support@mtcagua.com</p>
    </div>
</body>
</html>