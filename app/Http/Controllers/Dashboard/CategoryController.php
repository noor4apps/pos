<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        return view('dashboard.categories.index', compact('categories'));
    }// end of index

    public function create()
    {
        return view('dashboard.categories.create');
    }// end of create

}// end of controller
