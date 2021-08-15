<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
        $rules = [
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp|max:20480',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules['name->' . $locale] = 'required|max:50|unique:products';
            $rules['description->' . $locale] = 'required|max:255';
        }

        $request->validate($rules);

        $data = $request->except(['image']);
        if($request->image) {
            $name = $request->image->hashName();
            Image::make($request->image)->resize('400', null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $name));
            $data['image'] = $name;
        }

        Product::create($data);

        return redirect()->route('dashboard.products.index')->with('success', __('site.added_successfully'));

    } // end of story

    public function edit(Product $product) {

    } // end of edit

    public function update(Request $request, Product $product) {

    } // end of update

    public function destroy(Product $product) {

    } // end of destroy
}
