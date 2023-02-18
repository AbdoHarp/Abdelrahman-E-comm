@extends('layouts/admin')
@section('title', 'ADD Slider')

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
                    <h3>Edit Slider
                        <a href="{{ url('admin/sliders') }}" class="text-white btn btn-danger btn-sm float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/sliders/' . $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Slider Title</label>
                            <input type="text" name="title" value="{{ $slider->title }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Slider Description</label><br />
                            <textarea name="description" rows='5' class="form-control">{{ $slider->description }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image">
                            <img src="{{ asset($slider->image) }}" alt="img" width="60px" height="60px" />
                        </div>
                        <div class="mb-3">
                            <label>Slider status</label><br />
                            <input type="checkbox" {{ $slider->status == '1' ? 'checked' : '' }} name="status" />
                        </div>
                        <div class="mb-3">
                            <Button type="submit" class="btn btn-sm btn-success text-white float-end">Update
                                Slider</Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
