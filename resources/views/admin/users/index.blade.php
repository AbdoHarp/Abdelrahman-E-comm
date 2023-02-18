@extends('layouts/admin')
@section('title', 'Usera List')

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
                <div class="card-header">
                    <h3>
                        View Users
                        <a href="{{ url('admin/users/create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            Usera</a>
                    </h3>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role As</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $usersItem)
                                    <tr>
                                        <td>{{ $usersItem->id }}</td>
                                        <td>
                                            {{ $usersItem->name }}
                                        </td>
                                        <td>{{ $usersItem->email }}</td>
                                        <td>
                                            @if ($usersItem->role_as == 0)
                                                <label class="badge btn-primary">user</label>
                                            @elseif($usersItem->role_as == 1)
                                                <label class="badge btn-success">Admin</label>
                                            @else
                                                <label class="badge btn-danger">Noue</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/users/' . $usersItem->id . '/edit') }}"
                                                class="btn btn-success btn-sm text-white">
                                                Edit User
                                            </a>
                                            <a href="{{ url('admin/users/' . $usersItem->id . '/delete') }}"
                                                class="btn btn-danger btn-sm text-white">
                                                Delete User
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Users Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
