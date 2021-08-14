<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_categories'])->only(['index']);
        $this->middleware(['permission:create_categories'])->only(['create', 'store']);
        $this->middleware(['permission:update_categories'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_categories'])->only(['destroy']);
    }// end of construct

    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(5);

        return view('dashboard.categories.index', compact('categories'));
    }// end of index

    public function create()
    {
        return view('dashboard.categories.create');
    }// end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        Category::create($request->all());

        return redirect()->route('dashboard.categories.index')->with('success', __('site.added_successfully'));
    }// end of store

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }// end of edit

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id
        ]);

        $category->update($request->all());

        return redirect()->route('dashboard.categories.index')->with('success', __('site.updated_successfully'));

    }// end of update

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('success', __('site.deleted_successfully'));
    }// end of destroy

}// end of controller
