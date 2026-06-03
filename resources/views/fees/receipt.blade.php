<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt - {{ $fee->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .receipt {
            background-color: white;
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 28px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
        }
        .receipt-number {
            text-align: right;
            margin-bottom: 20px;
            color: #666;
            font-size: 12px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-weight: bold;
            color: #3b82f6;
            margin-bottom: 10px;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        .field-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
            font-size: 13px;
        }
        .field-label {
            color: #666;
            font-weight: 500;
        }
        .field-value {
            color: #333;
            text-align: right;
        }
        .summary {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
        }
        .summary-row.total {
            border-top: 2px solid #3b82f6;
            border-bottom: 2px solid #3b82f6;
            padding: 12px 0;
            font-weight: bold;
            color: #3b82f6;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
        }
        .status-paid {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-partial {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-pending {
            background-color: #fee2e2;
            color: #991b1b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        td {
            padding: 8px;
            font-size: 13px;
            border-bottom: 1px solid #f3f4f6;
        }
        .amount-column {
            text-align: right;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>Excellence Public School</h1>
            <p>Fee Payment Receipt</p>
            <p style="font-size: 12px; color: #999; margin-top: 5px;">Official Receipt for Student Fee Payment</p>
        </div>

        <div class="receipt-number">
            <strong>Receipt #:</strong> {{ str_pad($fee->id, 6, '0', STR_PAD_LEFT) }}<br>
            <strong>Date:</strong> {{ now()->format('d/m/Y H:i') }}
        </div>

        <div class="section">
            <div class="section-title">Student Information</div>
            <div class="field-row">
                <span class="field-label">Name:</span>
                <span class="field-value">{{ $fee->student->full_name }}</span>
            </div>
            <div class="field-row">
                <span class="field-label">Student ID:</span>
                <span class="field-value">{{ $fee->student->roll_number }}</span>
            </div>
            <div class="field-row">
                <span class="field-label">Class:</span>
                <span class="field-value">{{ $fee->student->class_name }}</span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Fee Details</div>
            <div class="field-row">
                <span class="field-label">Fee Amount:</span>
                <span class="field-value">Rs. {{ number_format($fee->fee_amount, 2) }}</span>
            </div>
            <div class="field-row">
                <span class="field-label">Description:</span>
                <span class="field-value">{{ $fee->description ?? 'Monthly Fee' }}</span>
            </div>
            <div class="field-row">
                <span class="field-label">Due Date:</span>
                <span class="field-value">{{ $fee->due_date->format('d/m/Y') }}</span>
            </div>
            <div class="field-row">
                <span class="field-label">Payment Status:</span>
                <span class="field-value">
                    @if($fee->payment_status === 'Paid')
                        <span class="status-badge status-paid">PAID</span>
                    @elseif($fee->payment_status === 'Partial')
                        <span class="status-badge status-partial">PARTIAL</span>
                    @else
                        <span class="status-badge status-pending">PENDING</span>
                    @endif
                </span>
            </div>
        </div>

        <div class="summary">
            <div class="summary-row">
                <span>Fee Amount</span>
                <span>Rs. {{ number_format($fee->fee_amount, 2) }}</span>
            </div>
            <div class="summary-row">
                <span>Amount Paid</span>
                <span style="color: #10b981;">Rs. {{ number_format($fee->paid_amount, 2) }}</span>
            </div>
            <div class="summary-row total">
                <span>Remaining Balance</span>
                <span>Rs. {{ number_format($fee->fee_amount - $fee->paid_amount, 2) }}</span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Payment History</div>
            @if($fee->payments && $fee->payments->count() > 0)
                <table>
                    <thead>
                        <tr style="border-bottom: 2px solid #3b82f6;">
                            <td style="font-weight: bold;">Date</td>
                            <td style="font-weight: bold;">Amount</td>
                            <td style="font-weight: bold;">Method</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fee->payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_date->format('d/m/Y') }}</td>
                            <td class="amount-column">Rs. {{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->payment_method ?? 'Cash' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #666; font-size: 13px; text-align: center; padding: 20px;">No payments recorded yet</p>
            @endif
        </div>

        <div class="footer">
            <p>This is an official receipt from {{ config('app.name', 'School Management System') }}</p>
            <p>For any queries, please contact the administrative office</p>
            <p style="margin-top: 15px; font-size: 11px;">Generated on {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
