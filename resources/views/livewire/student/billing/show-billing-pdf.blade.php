<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GST Invoice</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; background: #f8fafc; }
        .invoice-box { max-width: 850px; margin: auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.08); }
        .logo { height: 36px; margin-bottom: 20px; }
        .heading { font-size: 28px; font-weight: bold; color: #4f46e5; margin-bottom: 10px; }
        .subheading { font-size: 16px; color: #6b7280; margin-bottom: 20px; }
        .section-title { font-size: 18px; font-weight: 600; color: #111827; margin-top: 30px; margin-bottom: 10px; }
        .details-table, .summary-table, .gst-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .details-table td, .summary-table td, .summary-table th, .gst-table td, .gst-table th { padding: 8px; border: 1px solid #e5e7eb; }
        .summary-table th, .gst-table th { background: #f3f4f6; text-align: left; }
        .summary-table td:last-child, .summary-table th:last-child, .gst-table td:last-child, .gst-table th:last-child { text-align: right; }
        .total-row { font-weight: bold; background: #f3f4f6; }
        .info-label { color: #6b7280; font-size: 13px; }
        .info-value { font-size: 15px; font-weight: 500; }
        .footer { margin-top: 40px; color: #6b7280; font-size: 12px; text-align: center; }
        .signature { margin-top: 40px; text-align: right; font-size: 14px; }
        .gstin { font-size: 13px; color: #374151; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table width="100%">
            <tr>
                <td>
                    <img src="{{ public_path('assets/LearnSyntax.png') }}" class="logo" alt="Logo">
                </td>
                <td align="right">
                    <span class="heading">TAX INVOICE</span><br>
                    <span class="subheading">Invoice No: {{ $payment->order_id }}</span><br>
                    @if(!empty($payment->transaction_id))
                        <span class="subheading">Transaction ID: {{ $payment->transaction_id }}</span><br>
                    @endif
                </td>
            </tr>
        </table>

        <div class="section-title">Billed To</div>
        <table class="details-table">
            <tr>
                <td class="info-label">Name</td>
                <td class="info-value">{{ $payment->student->name ?? '-' }}</td>
                <td class="info-label">Email</td>
                <td class="info-value">{{ $payment->student->email ?? '-' }}</td>
            </tr>
            <tr>
                <td class="info-label">Phone</td>
                <td class="info-value">{{ $payment->student->contact ?? '-' }}</td>
                <td class="info-label">Payment Date</td>
                <td class="info-value">{{ $payment->created_at->format('d M Y, h:i A') }}</td>
            </tr>
        </table>

        <div class="section-title">Transaction Details</div>
        <table class="details-table">
            <tr>
                <td class="info-label">Type</td>
                <td class="info-value">
                    @if($payment->course_id)
                        Course
                    @else
                        Subscription
                    @endif
                </td>
                <td class="info-label">@if($payment->course_id)Course Name @else Subscription Plan @endif</td>
                <td class="info-value">
                    @if($payment->course_id)
                        {{ $payment->course->title ?? '-' }}
                    @else
                        {{ $payment->subscriptionPlan->name ?? 'Subscription' }}
                        @if(!empty($payment->subscriptionPlan->description))<br><span class="text-xs text-gray-500">{{ $payment->subscriptionPlan->description }}</span>@endif
                    @endif
                </td>
            </tr>
        </table>

        <div class="section-title">GST Fee Summary</div>
        <table class="gst-table">
            <tr>
                <th>Description</th>
                <th>Taxable Value (INR)</th>
                <th>GST Rate</th>
                <th>GST Amount (INR)</th>
                <th>Total (INR)</th>
            </tr>
            <tr>
                <td>@if($payment->course_id)Course Fee @else Subscription Fee @endif</td>
                <td>₹{{ number_format($payment->amount, 2) }}</td>
                <td>18%</td>
                <td>₹{{ number_format($payment->gst_amount ?? 0, 2) }}</td>
                <td>₹{{ number_format(($payment->amount ?? 0) + ($payment->gst_amount ?? 0), 2) }}</td>
            </tr>
            @if($payment->transaction_fee > 0)
            <tr>
                <td>Extra Charges</td>
                <td>₹{{ number_format($payment->transaction_fee, 2) }}</td>
                <td>-</td>
                <td>-</td>
                <td>₹{{ number_format($payment->transaction_fee, 2) }}</td>
            </tr>
            @endif
            <tr class="total-row">
                <td colspan="4">Grand Total</td>
                <td>₹{{ number_format($payment->total_amount + ($payment->transaction_fee ?? 0), 2) }}</td>
            </tr>
        </table>

        <div class="signature">
            <div>For LearnSyntax</div>
            <br><br>
            <div>Authorized Signatory</div>
        </div>

        <div class="footer">
            This is a system generated GST invoice. For any queries, contact support@learnsyntax.com
        </div>
    </div>
</body>
</html>
