<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Carts;
use Livewire\Component;

class Show extends Component
{
    public $cart, $totalPrice = 0;



    // decrementQuantity //---------------------------------\\

    public function decrementQuantity(int $cartId)
    {
        $cartData = Carts::where('id', $cartId)->where("user_id", auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productcolor()->where('id', $cartData->product_color_id)->exists()) {
                $productcolor = $cartData->productcolor()->where('id', $cartData->product_color_id)->first();
                if ($productcolor->quantity > $cartData->quantity) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'quantity Updated to Cart',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only'  . $productcolor->quantity . 'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'quantity Updated to Cart',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only' . $cartData->product->quantity . 'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'something Went Wrong! ',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    // incrementQuantity //=------------------------
    public function incrementQuantity(int $cartId)
    {
        $cartData = Carts::where('id', $cartId)->where("user_id", auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productcolor()->where('id', $cartData->product_color_id)->exists()) {
                $productcolor = $cartData->productcolor()->where('id', $cartData->product_color_id)->first();
                if ($productcolor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'quantity Updated to Cart',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only' . $productcolor->quantity . 'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'quantity Updated to Cart',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only' . $cartData->product->quantity . 'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'something Went Wrong! ',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    //removeCartItem ---------------------------------\\

    public function removeCartItem(int $cartId)
    {
        $cartRemoveData = Carts::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
        if ($cartRemoveData) {
            $cartRemoveData->delete();
            $this->emit('cartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart Item Removed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'something Went Wrong! ',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    // ---------------------------------\\

    public function render()
    {
        $this->cart = Carts::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.show', [
            'cart' => $this->cart
        ]);
    }
}
