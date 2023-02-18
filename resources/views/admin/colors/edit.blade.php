@extends('layouts/admin')
@section('title', 'EDIT COLORS')

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
                    <h3>Edit Colors
                        <a href="{{ url('admin/colors') }}" class="text-white btn btn-danger btn-sm float-end">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('admin/colors/' . $colors->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Color Name</label>
                            <input type="text" name="name" value="{{ $colors->name }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Color Code</label><br />
                            <input type="text" name="code" class="form-control" value="{{ $colors->code }}" />
                        </div>
                        <div class="mb-3">
                            <label>Color Status</label><br />
                            <input type="checkbox" name="status"{{ $colors->status == '1' ? 'checked' : '' }} />
                        </div>
                        <div class="mb-3">
                            <Button type="submit" class="btn btn-sm btn-success text-white float-end">Update</Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
