<div>
    <div class="row">
        <div class="col-md-3">
            @if ($category->brands)


                <div class="card">
                    <div class="card-header">
                        <h4>Brands</h4>
                    </div>
                    <div class="card-body">
                        @forelse ($category->brands as $barndItem)
                            <label class="d-block">
                                <input type="checkbox" wire:model="brandInputs" value="{{ $barndItem->name }}" />
                                {{ $barndItem->name }}
                            </label>
                        @empty
                            <div class="col-md-12">
                                <h5>No Branded</h5>
                            </div>
                        @endforelse
                    </div>

                </div>
            @endif
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Price</h4>
                </div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" class="form-check-input" name="priceSort" wire:model="priceInput"
                            value="high-to-low" /> High to low
                    </label>
                    <label class="d-block">
                        <input type="radio" class="form-check-input" name="priceSort" wire:model="priceInput"
                            value="low-to-high" /> Low to High
                    </label>
                </div>

            </div>
        </div>

        <div class="col-md-9">


            <div class="row">
                @forelse ($products as $productItem)
                    <div class="col-md-4">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($productItem->quantity > 0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out Stock</label>
                                @endif
                                @if ($productItem->productImages->count() > 0)
                                    <a
                                        href="{{ url('collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                        <img src="{{ asset($productItem->productImages[0]->image) }}"
                                            alt="{{ $productItem->name }}">
                                    </a>
                                @endif
                            </div>
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
                                    <a href="" class="btn btn1">Add To Cart</a>
                                    <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h5>No Products {{ $category->name }}</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
