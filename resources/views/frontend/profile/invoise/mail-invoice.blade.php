<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="text-center">
        <h2> Thank You for your Order </h2>
        <p>Thank you for purchasing with
            {{ $appsetting->website_name ?? 'Abdelrahman web It' }}
            <br />
            Your order items and details are provided below.
        </p>
    </div>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">{{ $appsetting->website_name ?? 'Abdelrahman web It' }}</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #{{ $order->id }}</span> <br>
                    <span>Date: {{ $order->created_at->format('d-m-Y') }}</span> <br>
                    <span>Zip code : {{ $order->pincode }}</span> <br>
                    <span>Address: {{ $order->address }}</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $order->id }}</td>

                <td>Full Name:</td>
                <td>{{ $order->fullname }}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>{{ $order->tracking_no }}</td>

                <td>Email Id:</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ $order->created_at->format('d-m-Y') }}</td>

                <td>Phone:</td>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>{{ $order->payment_mode }}</td>

                <td>Address:</td>
                <td>{{ $order->address }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>{{ $order->status_message }}</td>

                <td>Pin code:</td>
                <td>{{ $order->pincode }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalprice = 0;
            @endphp
            @foreach ($order->orderitems as $ordersitem)
                <tr>
                    <td width="10%">{{ $ordersitem->id }}</td>
                    <td>
                        {{ $ordersitem->product->name }}
                        @if ($ordersitem->productcolor)
                            @if ($ordersitem->productcolor->color)
                                <span>- Color:
                                    {{ $ordersitem->productcolor->color->name }}</span>
                            @endif
                        @endif
                    </td>
                    <td width="10%">{{ $ordersitem->price }}</td>
                    <td width="10%">{{ $ordersitem->quantity }}</td>
                    <td width="15%" class="fw-bold">
                        {{ $ordersitem->quantity * $ordersitem->price }}
                    </td>
                    @php
                        $totalprice += $ordersitem->quantity * $ordersitem->price;
                    @endphp

                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="total-heading">Total Amount :- <small>Inc. all vat/tax</small> :</td>
                <td colspan="1" class="total-heading"> {{ $totalprice }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with Abdelrahman of Web IT
    </p>

</body>

</html>
