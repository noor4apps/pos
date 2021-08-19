<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($query) use ($request) {

            return $query->when($request->search, function ($q) use ($request) {

                return $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('address', 'like', '%' . $request->search . '%')

                    ->orWhere('total_price', $request->search);
            });

        })->latest()->paginate(5);

        return view('dashboard.orders.index', compact('orders'));
    } // end of index

    public function products(Order $order)
    {
        $products = $order->products;
        return view('dashboard.orders.products._index', compact('products', 'order'));

    } //end of products

} // end of controller
