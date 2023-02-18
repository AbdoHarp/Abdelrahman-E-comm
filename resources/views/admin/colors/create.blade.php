@extends('layouts/admin')
@section('title', 'ADD COLORS')

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
                    <h3>Add Colors
                        <a href="{{ url('admin/colors') }}" class="text-white btn btn-danger btn-sm float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/colors/create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Color Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Color Code</label><br />
                            <input type="text" name="code" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label>Color Status</label><br />
                            <input type="checkbox" name="status" />
                        </div>
                        <div class="mb-3">
                            <Button type="submit" class="btn btn-sm btn-success text-white float-end">Submit</Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
