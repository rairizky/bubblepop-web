<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Promo;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {

        $promos = Promo::all()->sortBy('created_at')->take(3);

        $menus = Menu::all()->sortByDesc('created_at')->take(3);

        return view('layouts.front.page.index', compact('menus', 'promos'));
    }

    public function menu() {

        $menus = Menu::orderBy('created_at', 'desc')->paginate(8);

        return view('layouts.front.page.menu', compact('menus'));
    }

    public function detailMenu($id) {

        $get_menu = Menu::find($id);

        return view('layouts.front.page.detailmenu', compact('get_menu'));
    }

    public function about() {

        return view('layouts.front.page.about');
    }

    public function contact() {

        return view('layouts.front.page.contact');
    }
    
}
