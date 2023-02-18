@extends('layouts/app')

@section('title', 'My Orders')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">My Orders</h4>
                        <div class="underline mb-4"></div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tracking No</th>
                                        <th>User Name</th>
                                        <th>Payment Mode</th>
                                        <th>Orderd Date</th>
                                        <th>status Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $orderitem)
                                        <tr>
                                            <td>{{ $orderitem->id }}</td>
                                            <td>{{ $orderitem->tracking_no }}</td>
                                            <td>{{ $orderitem->fullname }}</td>
                                            <td>{{ $orderitem->payment_mode }}</td>
                                            <td>{{ $orderitem->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $orderitem->status_message }}</td>
                                            <td><a href="{{ url('orders/' . $orderitem->id) }}"
                                                    class="btn btn-success btn-sm">View</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Orders Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
