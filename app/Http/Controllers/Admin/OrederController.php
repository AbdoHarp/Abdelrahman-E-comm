<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrederController extends Controller
{
    public function index()
    {
        $todayDate = Carbon::now();
        $orders = Order::where('created_at', $todayDate)->paginate(10);
        return view('admin/order/inder', compact('orders'));
    }
}
