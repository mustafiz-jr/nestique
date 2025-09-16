<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Nestique</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Mr+Dafoe&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #F5F5F5;
            --color-secondary: #ac8e51;
            --color-accent: #415E72;
            --color-tertiary: #FFA673;
            --color-dark: #222222;
            --color-light: #FFFFFF;
            --primary-font: "Inter", sans-serif;
            --secondary-font: "Playfair Display", serif;
            --logo-font: "Mr Dafoe", cursive;
        }

        .primary-btn {
            padding: 7px 10px;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            background-color: var(--color-primary);
            color: var(--color-accent);
            border: 1px solid var(--color-accent);
            border-radius: 3px;
        }

        .primary-btn:hover {
            background-color: var(--color-accent);
            color: var(--color-primary);
            border: 1px solid var(--color-accent);
        }

        .secondary-btn {
            padding: 7px 10px;
            text-decoration: none;
            text-align: center;
            background-color: var(--color-secondary);
            color: var(--color-light);
            border-radius: 3px;
            font-weight: bold;
            border: var(--color-secondary) 1px solid;
        }

        .secondary-btn:hover {
            background-color: var(--color-accent);
            color: var(--color-light);
            border: 1px solid var(--color-accent);
        }

        .invoice-container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: var(--color-light);
            padding: 30px;
            border: 1px solid #e0e0e0;
        }

        /* Header Styles */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .logo {
            font-family: var(--logo-font);
            font-size: 42px;
            color: var(--color-secondary);
            margin-bottom: 5px;
        }

        .tagline {
            font-family: var(--secondary-font);
            color: var(--color-accent);
            font-size: 16px;
            letter-spacing: 1.5px;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h1 {
            font-family: var(--secondary-font);
            color: var(--color-dark);
            font-size: 28px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .invoice-title p {
            color: var(--color-accent);
            font-size: 14px;
        }

        /* Company and Client Info */
        .info-sections {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-box {
            padding: 0;
        }

        .info-box h3 {
            font-family: var(--secondary-font);
            color: var(--color-secondary);
            margin-bottom: 15px;
            font-size: 18px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-detail {
            margin-bottom: 8px;
            display: flex;
        }

        .info-detail strong {
            min-width: 100px;
            display: inline-block;
            color: var(--color-accent);
        }

        /* Invoice Details */
        .invoice-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .detail-card {
            padding: 15px;
            border-radius: 4px;
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        .detail-card h3 {
            font-size: 14px;
            color: var(--color-accent);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .detail-card p {
            font-size: 16px;
            font-weight: 600;
            color: var(--color-dark);
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th {
            background-color: #f9f9f9;
            color: var(--color-dark);
            padding: 12px 15px;
            text-align: left;
            font-weight: 500;
            border-bottom: 2px solid var(--color-secondary);
        }

        .items-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        .items-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .items-table tr:last-child td {
            border-bottom: none;
        }

        .text-right {
            text-align: right;
        }

        /* Totals Section */
        .totals-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .notes {
            padding: 0;
        }

        .notes h3 {
            font-family: var(--secondary-font);
            color: var(--color-secondary);
            margin-bottom: 15px;
            font-size: 18px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .notes p {
            margin-bottom: 10px;
            font-size: 14px;
            color: #555;
        }

        .totals {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .totals h3 {
            font-family: var(--secondary-font);
            color: var(--color-secondary);
            margin-bottom: 15px;
            font-size: 18px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .total-row.final {
            font-weight: 700;
            font-size: 18px;
            color: var(--color-secondary);
            border-bottom: none;
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid var(--color-secondary);
        }

        /* Footer */
        .invoice-footer {
            margin-top: 40px;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: var(--color-accent);
            font-size: 14px;
        }

        .action-buttons {
            display: flex;
            justify-content: end;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 30px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary {
            background-color: var(--color-secondary);
            color: var(--color-light);
            border: 1px solid var(--color-secondary);
        }

        .btn-primary:hover {
            background-color: #9a7d46;
            border-color: #9a7d46;
        }

        .btn-secondary {
            background-color: var(--color-light);
            color: var(--color-accent);
            border: 1px solid var(--color-accent);
        }

        .btn-secondary:hover {
            background-color: var(--color-accent);
            color: var(--color-light);
        }

        /* Print Styles */
        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .invoice-container {
                border: none;
                padding: 0;
            }

            .action-buttons {
                display: none;
            }

            .invoice-footer {
                margin-top: 50px;
            }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            /* .invoice-header {
                flex-direction: column;
                text-align: center;
            } */

            .invoice-title {
                text-align: center;
                margin-top: 20px;
            }

            .info-sections {
                grid-template-columns: 1fr 1fr;
            }

            .invoice-details {
                grid-template-columns: 1fr 1fr 1fr;
            }

            .totals-section {
                grid-template-columns: 2fr 1fr;
            }

            /* .items-table {
                display: block;
                width: 90vw;
                overflow-x: auto;
                grid-template-columns: 1fr;
            } */

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="action-buttons">
            <a href="{{ route('profile.index') }}" class="primary-btn"><i class="fa-solid fa-arrow-left"></i>
                Back</a>
            <button class="secondary-btn" onclick="window.print()">
                <i class="fas fa-print"></i> Print Invoice
            </button>
        </div>

        {{-- Header --}}
        <div class="invoice-header">
            <div class="company-info">
                <div class="logo">Nestique</div>
                <div class="tagline">The Nest of Timeless Fashion</div>
                <div class="contact-info" style="margin-top: 15px;">
                    <p>123 Design Street, Interior City</p>
                    <p>Phone: (123) 456-7890 | Email: info@nestique.com</p>
                </div>
            </div>
            <div class="invoice-title">
                <h1>INVOICE</h1>
                <p>#{{ $order->order_number ?? 'NTQ-' . $order->id }}</p>
            </div>
        </div>

        {{-- Billing & Company Info --}}
        <div class="info-sections">
            <div class="info-box">
                <h3>Billed To</h3>
                <div class="info-detail"><strong>Name:</strong> {{ $user->name }}</div>
                <div class="info-detail"><strong>Email:</strong> {{ $user->email }}</div>
                <div class="info-detail"><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</div>
                <div class="info-detail"><strong>Address:</strong>
                    {{ json_decode($order->billing_address)->address ?? 'N/A' }},
                    {{ json_decode($order->billing_address)->city ?? '' }},
                    {{ json_decode($order->billing_address)->zip ?? '' }}
                </div>
            </div>

            <div class="info-box">
                <h3>Company Details</h3>
                <div class="info-detail"><strong>Name:</strong> Nestique Ltd.</div>
                <div class="info-detail"><strong>Email:</strong> billing@nestique.com</div>
                <div class="info-detail"><strong>Phone:</strong> (123) 456-7890</div>
                <div class="info-detail"><strong>Address:</strong> 123 Design Street, Interior City</div>
            </div>
        </div>

        {{-- Invoice Details --}}
        <div class="invoice-details">
            <div class="detail-card">
                <h3>Invoice Date</h3>
                <p>{{ \Carbon\Carbon::parse($order->created_at)->format('F d, Y') }}</p>
            </div>
            <div class="detail-card">
                <h3>Due Date</h3>
                <p>{{ \Carbon\Carbon::parse($order->created_at)->addDays(30)->format('F d, Y') }}</p>
            </div>
            <div class="detail-card">
                <h3>Payment Method</h3>
                <p>{{ ucfirst($order->payment_method) ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Items Table --}}
        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td class="text-right">${{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
                @if ($order->shipping_amount > 0)
                    <tr>
                        <td>Shipping</td>
                        <td>1</td>
                        <td>${{ number_format($order->shipping_amount, 2) }}</td>
                        <td class="text-right">${{ number_format($order->shipping_amount, 2) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{-- Totals and Notes --}}
        <div class="totals-section">
            <div class="notes">
                <h3>Notes</h3>
                <p>{{ $order->notes ?? 'Thank you for your purchase!' }}</p>
            </div>
            <div class="totals">
                <h3>Invoice Summary</h3>
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Tax:</span>
                    <span>${{ number_format($order->tax_amount, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Shipping:</span>
                    <span>${{ number_format($order->shipping_amount, 2) }}</span>
                </div>
                @if ($order->discount_amount > 0)
                    <div class="total-row">
                        <span>Discount:</span>
                        <span>-${{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                @endif
                <div class="total-row final">
                    <span>Total Due:</span>
                    <span>${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="invoice-footer">
            <p>Thank you for choosing Nestique for your fashion needs</p>
            <p>www.nestique.com | info@nestique.com | (123) 456-7890</p>
        </div>

        <div class="page-break"></div>
    </div>


    <script>
        // Simple JavaScript to handle print functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add any additional functionality if needed
        });
    </script>
</body>

</html>
