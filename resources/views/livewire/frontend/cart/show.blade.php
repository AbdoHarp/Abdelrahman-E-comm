<div class="py-3 py-md-5">
    <div class="container">
        <h4>My Cart</h4>
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
                                <h4>Quantity</h4>
                            </div>
                            <div class="col-md-1">
                                <h4>Total</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Remove</h4>
                            </div>
                        </div>
                    </div>

                    @forelse ($cart as $cartitem)
                        @if ($cartitem->product)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a
                                            href="{{ url('collections/' . $cartitem->product->category->slug . '/' . $cartitem->product->slug) }}">
                                            <label class="product-name">
                                                @if ($cartitem->product->productImages)
                                                    <img src="{{ asset($cartitem->product->productImages[0]->image) }}"
                                                        style="width: 50px; height: 50px"
                                                        alt="{{ $cartitem->product->name }}">
                                                @else
                                                    <img src="" style="width: 50px; height: 50px"alt="">
                                                @endif
                                                {{ $cartitem->product->name }}
                                                @if ($cartitem->productcolor)
                                                    @if ($cartitem->productcolor->color)
                                                        <span>- Color:
                                                            {{ $cartitem->productcolor->color->name }}</span>
                                                    @endif
                                                @endif
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-7 my-auto">
                                        <div class="quantity">
                                            <div class="input-group">
                                                <button type="button" wire:loading.attr="disabled"
                                                    wire:click="decrementQuantity({{ $cartitem->id }})"
                                                    class="btn btn1"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{ $cartitem->quantity }}"
                                                    class="input-quantity" />
                                                <button type="button" wire:loading.attr="disabled"
                                                    wire:click="incrementQuantity({{ $cartitem->id }})"
                                                    class="btn btn1"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label
                                            class="price">{{ $cartitem->product->selling_price * $cartitem->quantity }}
                                            EGP</label>
                                        @php $totalPrice += $cartitem->product->selling_price * $cartitem->quantity  @endphp
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            <button type="button" wire:loading.attr="disabled"
                                                wire:click="removeCartItem({{ $cartitem->id }})"
                                                class="btn btn-danger btn-sm">
                                                <span wire:loading.remove
                                                    wire:target="removeCartItem({{ $cartitem->id }})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target="removeCartItem({{ $cartitem->id }})">
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
                            <h5>No Cart Items Added</h5>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 my-md-auto mt-3">
                <h5>
                    Get the best deals & offers <a href="{{ url('/collections') }}">shop now</a>
                </h5>
            </div>
            <div class="col-md-4 mt-3">
                <div class="shadow-sm bg-white p-3">
                    <h4>Total :
                        <span class="float-end">{{ $totalPrice }} EGP</span>
                    </h4>
                    <hr>
                    <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">checkout</a>
                </div>
            </div>
        </div>

    </div>
</div>
