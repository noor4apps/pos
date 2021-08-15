<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_products'])->only(['index']);
        $this->middleware(['permission:create_products'])->only(['create', 'store']);
        $this->middleware(['permission:update_products'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_products'])->only(['destroy']);
    }// end of construct

    public function index(Request $request) {
        $products = Product::paginate(5);
        return view('dashboard.products.index', compact('products'));
    } // end of index

    public function create() {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    } // end of create

    public function store(Request $request) {

    } // end of story

    public function edit(Product $product) {

    } // end of edit

    public function update(Request $request, Product $product) {

    } // end of update

    public function destroy(Product $product) {

    } // end of destroy
}
