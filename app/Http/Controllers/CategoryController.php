<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $posts = $category->posts()->paginate(10);
        return view('categories.index', compact('category','posts'));
    }
}
