<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_orders'])->only(['create', 'store']);
        $this->middleware(['permission:update_orders'])->only(['edit', 'update']);
    }// end of construct

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create', compact('client', 'categories'));

    } // end of create

    public function store(Request $request, Client $client)
    {
//        dd($request->all(), $client->id);

        $request->validate([
            'products' => 'required',
        ]);

        $this->attach_order($request, $client);

        return redirect()->route('dashboard.orders.index')->with('success', __('site.added_successfully'));

    } // end of store

    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.edit', compact('client', 'order', 'categories'));

    } // end of store

    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => 'required',
        ]);

        $this->detach_order($order);

        $this->attach_order($request, $client);

        return redirect()->route('dashboard.orders.index')->with('success', __('site.updated_successfully'));

    } // end of update

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create(['total_price' => 0]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);
        }

        $order->update(['total_price' => $total_price]);

    }//end of attach order

    private function detach_order($order)
    {
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }

        $order->delete();

    }//end of detach order

} // end of controller
