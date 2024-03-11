<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function categoryView(Category $category, Announcement $announcement, $id)
    {

        $category = Category::findOrFail($id);

        return view('pages.category.category', compact('category'));
    }
}