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
    public function index()
    {

    } // end of index

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create', compact('client', 'categories'));

    } // end of create

    public function store(Request $request, Client $client)
    {
//        dd($request->all(), $client->id);

        $request->validate([
            'product_ids' => 'required',
            'quantities' => 'required',
        ]);

        $order = $client->orders()->create(['total_price' => 0]);

        $total_price = 0;

        foreach ($request->product_ids as $index => $product_id) {

            $product = Product::FindOrFail($product_id);
            $total_price += $product->sale_price * $request->quantities[$index];

            $order->products()->attach($product_id, ['quantity' => $request->quantities[$index]]);

            $product->update([
                'stock' => $product->stock - $request->quantities[$index]
            ]);
        }

        $order->update(['total_price' => $total_price]);

    } // end of store

    public function edit(Client $client, Order $order)
    {

    } // end of store

    public function update(Request $request, Client $client, Order $order)
    {

    } // end of update

    public function destroy(Client $client, Order $order)
    {

    } // end of destroy

} // end of controller
