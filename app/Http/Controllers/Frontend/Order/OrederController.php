<?php

namespace App\Http\Controllers\frontend\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrederController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend/orders/index', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $orderId)->first();
        if ($order) {
            return view('frontend/orders/view', compact('order'));
        } else {
            return redirect()->back()->with('message', 'No Order Found');
        }
    }
}
