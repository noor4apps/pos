<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::whereRoleIs('admin')->count();
        $clients_count = Client::count();
        $categories_count = Category::count();
        $products_count = Product::count();

        return view('dashboard.index', compact('users_count', 'categories_count', 'products_count', 'clients_count'));

    }// end of index

}// end of controller
