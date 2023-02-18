<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Carts;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{

    public $category, $product, $prodColorSelectedQuantity, $quantityCount = 1, $productcolorid;

    public function addToWishList($product_id)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $product_id)->exists()) {
                session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added to wishlist',
                    'type' => 'error',
                    'status' => 409
                ]);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product_id
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message', 'Wishlist Added Successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added Successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to continue',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function colorSelected($productcolorid)
    {
        $this->productcolorid = $productcolorid;
        $productColor = $this->product->productColors()->where('id', $productcolorid)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if ($this->prodColorSelectedQuantity == 0) {
            $this->prodColorSelectedQuantity = 'outofstock';
        }
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        } else {
            'Maximum Number';
        }
    }
    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        } else {
            'Minmum Number';
        }
    }

    public function addToCart(int $productid)
    {
        if (Auth::check()) {
            // dd($productid);
            if ($this->product->where('id', $productid)->where('status', 0)->exists()) {
                //check for product color quantity and add to cart

                if ($this->product->productColors()->count() > 1) {
                    if ($this->prodColorSelectedQuantity) {
                        if (Carts::where('user_id', auth()->user()->id)->where('product_id', $productid)
                            ->where('product_color_id', $this->productcolorid)
                            ->exists()
                        ) {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'product Already Added',
                                'type' => 'warning',
                                'status' => 409
                            ]);
                        } else {
                            $productColor = $this->product->productColors()->where('id', $this->productcolorid)->first();
                            if ($productColor->quantity > 0) {
                                if ($productColor->quantity > $this->quantityCount) {
                                    //insert product to cart
                                    Carts::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productid,
                                        'product_color_id' => $this->productcolorid,
                                        'quantity' => $this->quantityCount
                                    ]);
                                    $this->emit("CartAddedUpdated");
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Product Added to Cart',
                                        'type' => 'success',
                                        'status' => 200
                                    ]);
                                } else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Only' . $productColor->quantity . 'Quantity Available',
                                        'type' => 'error',
                                        'status' => 404
                                    ]);
                                }
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Out of stock',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select your Product Color',
                            'type' => 'info',
                            'status' => 401
                        ]);
                    }
                } else {


                    if (Carts::where('user_id', auth()->user()->id)->where('status', '0')->exists()) {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'product Already Added',
                            'type' => 'danger',
                            'status' => 409
                        ]);
                    } else {


                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity > $this->quantityCount) {
                                //insert product to cart
                                // dd('an on');
                                Carts::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productid,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->emit("CartAddedUpdated");
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Added to Cart',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only' . $this->product->quantity . 'Quantity Available',
                                    'type' => 'error',
                                    'status' => 404
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out Of Stock',
                                'type' => 'error',
                                'status' => 404
                            ]);
                        }
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'product Does not found',
                    'type' => 'error',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to continue',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product
        ]);
    }
}
