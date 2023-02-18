@extends('layouts/app')


@section('title', 'User Profile')

@section('content')

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h4>
                        User Profile
                        <a href="{{ url('change-password') }}" class="btn btn-warning text-white btn-sm float-end">Change Password</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                <div class="col-md-10">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h4 class="md-0 text-white">User Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/profile') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>User Name</label>
                                            <input type="text" name="username" value="{{ Auth::user()->name }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email Address</label>
                                            <input type="text" readonly value="{{ Auth::user()->email }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone"
                                                value="{{ Auth::user()->userDetail->phone ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Zip/pin Code</label>
                                            <input type="text" name="zip_code"
                                                value="{{ Auth::user()->userDetail->zip_code ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Address</label>
                                            <textarea name="address" rows="3" class="form-control">{{ Auth::user()->userDetail->address ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-end">Save Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
