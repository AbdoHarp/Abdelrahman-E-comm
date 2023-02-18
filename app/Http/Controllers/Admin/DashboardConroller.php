<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\product;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardConroller extends Controller
{
    public function index()
    {
        $totalproducts = product::count();
        $totalcategories = Category::count();
        $totalBrands = Brand::count();

        $totalAllUsers = User::count();
        $totalUsers = User::where('role_as', '0')->count();
        $totalAdmin = User::where('role_as', '1')->count();

        $totalorders = Order::count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $todayorder = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
        $thisYearOrder = Order::whereYear('created_at', $thisYear)->count();

        return view('admin/dashboard', compact(
            'totalproducts',
            'totalcategories',
            'totalBrands',
            'totalAllUsers',
            'totalUsers',
            'totalAdmin',
            'totalorders',
            'todayorder',
            'thisMonthOrder',
            'thisYearOrder',
        ));
    }
}
