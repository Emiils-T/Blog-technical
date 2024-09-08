<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Category $category): View
    {
        $posts = $category->posts()->paginate(10);
        return view('categories.index', compact('category', 'posts'));
    }

}
