@extends('layouts/app')


@section('title', 'Search Products')

@section('content')

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>
                        Search Products
                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                @forelse ($searchProducts as $productItem)
                    <div class="col-md-10">
                        <div class="product-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-card-img">
                                        <label class="stock bg-danger">New</label>
                                        @if ($productItem->productImages->count() > 0)
                                            <a
                                                href="{{ url('collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                    alt="{{ $productItem->name }}">
                                            </a>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-9">
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $productItem->brand }}</p>
                                        <h5 class="product-name">
                                            <a
                                                href="{{ url('collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                {{ $productItem->name }}
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">{{ $productItem->selling_price }} EGP</span>
                                            <span class="original-price">{{ $productItem->original_price }} EGP</span>
                                        </div>
                                        <div class="mt-2">
                                            <a class="btn btn1">Add To Cart</a>
                                            <a class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                        </div>
                                        <p style="height: 45px; overflow: hidden;">
                                            <b> Description : </b>{{ $productItem->small_description }}
                                        </p>
                                        <a href="{{ url('collections/' . $productItem->category->slug . '/' . $productItem->slug) }}"
                                            class="btn btn-outline-primary">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="p-2">
                        <h5>No such Products Found</h5>
                    </div>
                @endforelse

                <div class=" md-10">
                    {{ $searchProducts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
