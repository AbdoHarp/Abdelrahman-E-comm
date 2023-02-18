@extends('layouts/admin')
@section('title', 'Edit Category')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">


                <div class="card-header">
                    <h3>Edit Category
                        <a href="{{ url('admin/category') }}" class="btn btn-danger text-white btn-sm float-end">Back</a>
                    </h3>

                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif


                    <form action="{{ url('/admin/update_category/' . $cate_item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Category Name</label>
                                <input type="text" class="form-control" value="{{ $cate_item->name }}" name="name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Slug</label>
                                <input type="text" class="form-control" value="{{ $cate_item->slug }}" name="slug">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Description</label>
                                <textarea type="text" id="mySummernote" class="form-control" rows="3" name="description">{{ $cate_item->description }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                                <img src="{{ asset($cate_item->image) }}" alt="img" width="60px" height="60px" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>status</label><br />
                                <input type="checkbox" name="status" {{ $cate_item->status == '1' ? 'checked' : '' }} />
                            </div>
                            <div class="col-md-12 mb-3">
                                <h6>SED Tags :</h6>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>meta_Title</label>
                                <input type="text" class="form-control" value="{{ $cate_item->meta_title }}"
                                    name="meta_title">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>meta_Description</label>
                                <textarea type="text" class="form-control" rows="3" name="meta_description">{{ $cate_item->meta_description }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>meta_Keyword</label>
                                <textarea type="text" class="form-control" rows="3" name="meta_keyword">{{ $cate_item->meta_keyword }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success flout-center">Update Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
