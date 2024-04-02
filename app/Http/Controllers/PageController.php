<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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
        if (session('locale') == 'en') {

            // Per il solo titolo 

            if ($request->searched && $request->searchedCategory == 'Category') {
                $announcements = Announcement::search($request->searched)->where('is_accepted', true)->paginate(10);
                return view('pages.announcement.index', compact('announcements'));
            }

            // Errore

            elseif (!$request->searched && $request->searchedCategory == 'Category') {
                return redirect()->back()->with('errorSearch', 'Ricerca sbagliata');
            }
        }

        if (session('locale') == 'es') {

            // Per il solo titolo 

            if ($request->searched && $request->searchedCategory == 'Categorías') {
                $announcements = Announcement::search($request->searched)->where('is_accepted', true)->paginate(10);
                return view('pages.announcement.index', compact('announcements'));
            }

            // Errore

            elseif (!$request->searched && $request->searchedCategory == 'Categorías') {
                return redirect()->back()->with('errorSearch', 'Ricerca sbagliata');
            }
        }






        // Quello incrociato



        if ($request->searched && $request->searchedCategory != 'Categorie') {
            $announcements = Announcement::search($request->searched)->where('is_accepted', true)->where('category_id', $request->searchedCategory)->paginate(10);

            return view('pages.announcement.index', compact('announcements'));
        }



        // Per il solo titolo 

        elseif ($request->searched && $request->searchedCategory == 'Categorie') {
            $announcements = Announcement::search($request->searched)->where('is_accepted', true)->paginate(10);
            return view('pages.announcement.index', compact('announcements'));
        }

        // Errore

        elseif (!$request->searched && $request->searchedCategory == 'Categorie') {
            return redirect()->back()->with('errorSearch', 'Ricerca sbagliata');
        }



        // Per la categoria

        elseif (!$request->searched && $request->searchedCategory != 'Categorie') {

            $announcements = Announcement::where('category_id', $request->searchedCategory)->where('is_accepted', true)->paginate(10);

            return view('pages.announcement.index', compact('announcements'));
        }
    }

    // Per la traduzione del sito

    public function setLanguage($locale)
    {

        App::setLocale($locale);
        Session::put("locale", $locale);

        $categories = Category::all();

        if ($locale == 'en') {

            $categoriesEn = ['Automotive', 'Electronics', 'Home Appliances', 'Book', 'Games', 'Sport', 'Property', 'Phone', 'Furnitures', 'Clothing'];


            for ($i = 0; $i <= $categories->count() - 1; $i++) {

                // dd('cia');
                $categories[$i]->name = $categoriesEn[$i];
                $categories[$i]->save();
            }
            return redirect()->back();
        } else if ($locale == 'es') {

            $categoriesEs = ['Motores', 'Electrónica', 'Electrodomésticos', 'Libros', 'Juegos', 'Deporte', 'Propiedades', 'Telefonos', 'Muebles', 'Ropa'];

            for ($i = 0; $i <= $categories->count() - 1; $i++) {

                // dd('cia');
                $categories[$i]->name = $categoriesEs[$i];
                $categories[$i]->save();
            }
            return redirect()->back();
        }

        $categoriesIt = ['Motori', 'Informatica', 'Elettrodomestici', 'Libri', 'Giochi', 'Sport', 'Immobili', 'Telefoni', 'Arredamento', 'Abbigliamento'];
        for ($i = 0; $i <= $categories->count() - 1; $i++) {

            // dd('cia');
            $categories[$i]->name = $categoriesIt[$i];
            $categories[$i]->save();
        }


        // session()->put('locale', $lang);
        return redirect()->back();
    }
}
