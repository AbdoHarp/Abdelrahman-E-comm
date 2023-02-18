<div class="py-3 py-md-5">
    <div class="container">
        <h4>My Withlist</h4>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Products</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Price</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Remove</h4>
                            </div>
                        </div>
                    </div>

                    @forelse ($wishlist as $wishitem)
                        @if ($wishitem->product)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a
                                            href="{{ url('collections/' . $wishitem->product->category->slug . '/' . $wishitem->product->slug) }}">
                                            <label class="product-name">
                                                <img src="{{ asset($wishitem->product->productImages[0]->image) }}"
                                                    style="width: 50px; height: 50px"
                                                    alt="{{ $wishitem->product->name }}">
                                                {{ $wishitem->product->name }}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label class="price">{{ $wishitem->product->selling_price }} EGP</label>
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            <button type="button" wire:click="removeWishlistItem({{ $wishitem->id }})"
                                                class="btn btn-danger btn-sm">
                                                <span wire:loading.remove
                                                    wire:target="removeWishlistItem({{ $wishitem->id }})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading
                                                    wire:target="removeWishlistItem({{ $wishitem->id }})">
                                                    <i class="fa fa-trash"></i> Removing...
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="col-md-3">
                            <h5>No Wishes Added</h5>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

    </div>
</div>
