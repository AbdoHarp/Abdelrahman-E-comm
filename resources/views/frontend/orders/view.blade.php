@extends('layouts/app')

@section('title', 'My Orders Details')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i> My Orders Details
                            <a href="{{ url('orders') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                        </h4>
                        <div class="underline mb-4"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Orders Details</h5>
                                <hr>
                                <h6>Order id: {{ $order->id }}</h6>
                                <h6>Tracking No: {{ $order->tracking_no }}</h6>
                                <h6>order Creared Date: {{ $order->created_at->format('d-m-Y') }}</h6>
                                <h6>Peyment Mode: {{ $order->payment_mode }}</h6>
                                <h6 class="border p-2 text-success">
                                    order Status Message:
                                    <span class="text-uppercase">{{ $order->status_message }}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Details</h5>
                                <hr>
                                <h6>Full Name: {{ $order->fullname }}</h6>
                                <h6>Email Id: {{ $order->email }}</h6>
                                <h6>Phone: {{ $order->phone }}</h6>
                                <h6>Address: {{ $order->address }}</h6>
                                <h6>Pin Code: {{ $order->pincode }}</h6>
                            </div>
                        </div>
                        <br />
                        <h5>Order Items</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-bold">Item ID</th>
                                        <th class="fw-bold">Image</th>
                                        <th class="fw-bold">Product</th>
                                        <th class="fw-bold">Price</th>
                                        <th class="fw-bold">Quantity</th>
                                        <th class="fw-bold">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalprice = 0;
                                    @endphp
                                    @foreach ($order->orderitems as $ordersitem)
                                        <tr>
                                            <td width="10%">{{ $ordersitem->id }}</td>
                                            <td width="10%">
                                                @if ($ordersitem->product->productImages)
                                                    <img src="{{ asset($ordersitem->product->productImages[0]->image) }}"
                                                        style="width: 50px; height: 50px"
                                                        alt="{{ $ordersitem->product->name }}">
                                                @else
                                                    <img src="" style="width: 50px; height: 50px"alt="">
                                                @endif
                                            </td>
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
                                            <td width="10%" class="fw-bold">
                                                {{ $ordersitem->quantity * $ordersitem->price }}
                                            </td>
                                            @php
                                                $totalprice += $ordersitem->quantity * $ordersitem->price;
                                            @endphp

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="fw-bold">Total Amount :</td>
                                        <td colspan="1" class="fw-bold"> {{ $totalprice }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
