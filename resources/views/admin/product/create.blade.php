@extends('layouts/admin')
@section('title', 'Add Products')

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
                    <h3>Add Products
                        <a href="{{ url('admin/product') }}" class="text-white btn btn-danger btn-sm float-end">Back</a>
                    </h3>

                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                    aria-controls="seotag-tab-pane" aria-selected="false">SEO
                                    Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="images-tab" data-bs-toggle="tab"
                                    data-bs-target="#images-tab-pane" type="button" role="tab"
                                    aria-controls="images-tab-pane" aria-selected="false">Porduct Images</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab"
                                    data-bs-target="#color-tab-pane" type="button" role="tab"
                                    aria-controls="color-tab-pane" aria-selected="false">Porduct Color</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0"><br />
                                <div class=" mb-3">
                                    <label>Category</label>
                                    <select name="categroy_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" mb-3">
                                    <label>Product Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class=" mb-3">
                                    <label>Product Slug</label>
                                    <input type="text" name="slug" class="form-control">
                                </div>
                                <div class=" mb-3">
                                    <label>Select Brands</label>
                                    <select name="brand" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" mb-3">
                                    <label>Small Description (500 Words)</label>
                                    <textarea rows="4" name="small_description" class="form-control"></textarea>
                                </div>
                                <div class=" mb-3">
                                    <label>Description</label>
                                    <textarea rows="4" name="description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel"
                                aria-labelledby="seotag-tab" tabindex="0"><br />
                                <div class=" mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" />
                                </div>
                                <div class=" mb-3">
                                    <label>Meta Keyword</label>
                                    <textarea rows="4" name="meta_keyword" class="form-control"></textarea>
                                </div>
                                <div class=" mb-3">
                                    <label>Meta Description</label>
                                    <textarea rows="4" name="meta_description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                aria-labelledby="details-tab" tabindex="0"><br />
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Original Price</label>
                                            <input type="text" name="original_price" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Selling Price</label>
                                            <input type="text" name="selling_price" class="form-control" />
                                        </div>
                                    </div>
                                    <div class=" mb-3">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control" />
                                    </div>
                                    <div class=" mb-3">
                                        <label>Trending</label>
                                        <input type="checkbox" name="trending" style='width:15px; height:15px;' />
                                    </div>
                                    <div class=" mb-3">
                                        <label>Featured</label>
                                        <input type="checkbox" name="featured" style='width:15px; height:15px;' />
                                    </div>
                                    <div class=" mb-3">
                                        <label>Status</label>
                                        <input type="checkbox" name="status" style='width:15px; height:15px;' />
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="images-tab-pane" role="tabpanel"
                                aria-labelledby="images-tab" tabindex="0"><br />
                                <div class="mb-3">
                                    <label>Upload Product Images</label>
                                    <input type="file" name="image[]" multiple class="form-control" />
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel"
                                aria-labelledby="color-tab" tabindex="0"><br />
                                <div class="mb-3">
                                    <label>Select Colors</label>
                                    <hr />
                                    <div class="row">
                                        @forelse ($colors as $color_item)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-2">
                                                    Color : <input type="checkbox" name="colors[{{ $color_item->id }}]"
                                                        value="{{ $color_item->id }}" />
                                                    {{ $color_item->name }}
                                                    <br />
                                                    Quantity : <input type="number"
                                                        name="colorquantity[{{ $color_item->id }}]"
                                                        style="width: 70px; border: 1px solid">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h4>No colors found</h4>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success float-end text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
