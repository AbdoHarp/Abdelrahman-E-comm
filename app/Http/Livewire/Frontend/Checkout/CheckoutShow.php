<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Mail\PlaceOrderMailable;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use PhpParser\Node\Expr\Cast;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;
    public $fullname, $email, $phone, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;


    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];

    // --------------------------------------------

    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = "paid by paypal";
        $codOrder = $this->placeOrder();
        if ($codOrder) {

            Carts::where("user_id", auth()->user()->id)->delete();
            session()->flash('message', 'Order placed Successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to("thank-you");
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    // --------------------------------------------

    public function validationForAll()
    {
        $this->validate();
    }

    // --------------------------------------------


    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'pincode' => 'required|string|max:6|min:5',
            'address' => 'required|string|max:500',
        ];
    }

    // --------------------------------------------


    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'Abdelrahman' . Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in Progress',
            'payment_mode' => $this->payment_mode,
            'payment_id ' => $this->payment_id
        ]);
        foreach ($this->carts as $cartitem) {
            $orderItems = Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartitem->product_id,
                'product_color_id' => $cartitem->product_color_id,
                'quantity' => $cartitem->quantity,
                'price' => $cartitem->product->selling_price
            ]);

            if ($cartitem->product_color_id != NULL) {
                $cartitem->productcolor()->where('id', $cartitem->product_color_id)->decrement('quantity', $cartitem->quantity);
            } else {
                $cartitem->product()->where('id', $cartitem->product_id)->decrement('quantity', $cartitem->quantity);
            }
        }

        return $order;
    }

    // --------------------------------------------


    public function codOrder()
    {
        $this->payment_mode = 'Cash On Delivery';
        $codOrder = $this->placeOrder();
        if ($codOrder) {

            Carts::where("user_id", auth()->user()->id)->delete();
            try {
                $order = Order::findOrFail($codOrder->id);
                Mail::to($order->email)->send(new PlaceOrderMailable($order));
                // Mail Sent Successfully
            } catch (\Exception $e) {
                // Something went Wrong
            }
            session()->flash('message', 'Order placed Successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to("thank-you");
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
        // $this->payment_mode = 'Cash On Delivery';
    }


    // --------------------------------------------


    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Carts::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartitem) {
            $this->totalProductAmount += $cartitem->product->selling_price * $cartitem->quantity;
        }
        return $this->totalProductAmount;
    }

    // --------------------------------------------


    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->phone = auth()->user()->userDetail->phone;
        $this->pincode = auth()->user()->userDetail->zip_code;
        $this->address = auth()->user()->userDetail->address;

        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }

    // --------------------------------------------

}
