<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Announcement;

class PageController extends Controller
{

    public function home()
    {
        $announcements = Announcement::where('is_accepted', true)->take(6)->orderBy('created_at', 'desc')->get();

        return view('pages.home', ['categories' => Category::all(), 'announcements' => $announcements]);
    }

    // public function searchByCategory(Request $request)
    // {

    //     $category = $request->input('category');

    //     $announcements = Announcement::where('category_id', $category)->get();

    //     return view('pages.home', ['announcements' => $announcements, 'categories' => Category::all()]);
    // }

    public function searchAnnouncements(Request $request)
    {
        $announcements = Announcement::search($request->searched)->where('is_accepted', true)->paginate(10);

        $category = Category::findOrFail($id);

        // da valutare dove 

        $announcements = Announcement::where('is_accepted', true)->take(6)->orderBy('created_at', 'desc')->get();

        return view('pages.category.category', ['category' => $category, 'announcements' => $announcements]);
    }
}
