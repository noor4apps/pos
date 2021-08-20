<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::whereRoleIs('admin')->count();
        $clients_count = Client::count();
        $categories_count = Category::count();
        $products_count = Product::count();

        $sales_data = Order::select(
            DB::raw('year(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw('SUM(total_price) as sum'))
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();

        return view('dashboard.index', compact('users_count', 'categories_count', 'products_count', 'clients_count', 'sales_data'));

    }// end of index

}// end of controller
