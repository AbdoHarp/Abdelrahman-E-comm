@extends('layouts/admin')

@section('title', 'My Orders')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>My Orders</h3>
                </div>
                <div class="card-body">

                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Filter by Date</label>
                                <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Filter by status</label>
                                <select name="status" class="form-select">
                                    <option value="">Select All Status</option>
                                    <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>
                                    <option value="completed" {{ Request::get('status') == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                    <option value="out-for-delivery"
                                        {{ Request::get('status') == 'out-for-delivery' ? 'selected' : '' }}>
                                        Out-For-Delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br />
                                <button type="submit" class="btn btn-sm text-white btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <hr />


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
                                        <td><a href="{{ url('admin/orders/' . $orderitem->id) }}"
                                                class="btn btn-success text-white btn-sm">View</a></td>
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


@endsection
