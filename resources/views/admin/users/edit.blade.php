@extends('layouts/admin')
@section('title', 'Edit User')

@section('content')
    {{-- <div>
        <livewire:admin.product.index />
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                <div class="card-header">
                    <h3>Edit User
                        <a href="{{ url('admin/users') }}" class="text-white btn btn-danger btn-sm float-end">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('admin/users/' . $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>User Name</label>
                                <input type="text" value="{{ $users->name }}" name="name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label><br />
                                <input name="email" type="email" readonly value="{{ $users->email }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Passwordd</label><br />
                                <input name="password" type="password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Select Role</label>
                                <select name="role_as" class="form-control">
                                    <option value="">select Role</option>
                                    <option value="0" {{ $users->role_as == '0' ? 'selected' : '' }}>User</option>
                                    <option value="1" {{ $users->role_as == '1' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-12 text-end">
                                <Button type="submit" class="btn btn-sm btn-success text-white float-end">
                                    Update User
                                </Button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
