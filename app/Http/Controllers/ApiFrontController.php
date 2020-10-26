<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Promo;
use App\Models\Topping;
use Illuminate\Http\Request;

class ApiFrontController extends Controller {

    public function search_menu(Request $request) {

        $query = $request->get('q');

        $search = Menu::where('name', 'like', '%'.$query.'%')->get();
        $search_obj = [];
        foreach ($search as $data) {
            array_push($search_obj, $data);
        }
        return response()->json([
            'status' => true,
            'total' => $search->count(),
            'query' => $search
        ], 200);
    }

    public function search_topping(Request $request) {

        $query = $request->get('q');

        $search = Topping::where('name', 'like', '%'.$query.'%')->get();
        $search_obj = [];
        foreach ($search as $data) {
            array_push($search_obj, $data);
        }
        return response()->json([
            'status' => true,
            'total' => $search->count(),
            'query' => $search
        ], 200);
    }

    public function header() {

        $menu = Menu::inRandomOrder()->limit(1)->get();

        return response()->json([
            'status' => true,
            'total' => $menu->count(),
            'menu' => $menu
        ]);
    }

    public function category() {
        $categories = Category::all()->sortByDesc('created_at');
        $category_obj = [];
        foreach ($categories as $data) {
            array_push($category_obj, $data);
        }
        return response()->json([
            'status' => true,
            'total' => $categories->count(),
            'category' => $category_obj,
        ], 200);
    }

    public function category_menu() {
        $category = Category::all()->where('name', '!=', 'topping');
        $category_obj = [];
        foreach ($category as $data) {
            array_push($category_obj, $data);
        }
        return response()->json([
            'status' => true,
            'total' => $category->count(),
            'category' => $category_obj
        ], 200);
    }

    public function category_topping() {
        $category = Category::all()->where('name', 'topping');
        $category_obj = [];
        foreach ($category as $data) {
            array_push($category_obj, $data);
        }
        return response()->json([
            'status' => true,
            'total' => $category->count(),
            'category' => $category_obj
        ], 200);
    }

    public function menu() {

        $menus = Menu::all()->sortByDesc('created_at');
        $menu_obj = [];
        foreach ($menus as $data) {
            array_push($menu_obj, $data);
        }
        return response()->json([
            'status' => true,
            'total' => $menus->count(),
            'menu' => $menu_obj,
        ], 200);
    }

    public function detail_menu($id) {

        $find_menus = Menu::find($id);
        return response()->json([
            'status' => true,
            'menu' => $find_menus
        ], 200);
    }

    public function topping() {
        $topping = Topping::all()->sortByDesc('created_at');
        $topping_obj = [];
        foreach ($topping as $data) {
            array_push($topping_obj, $data);
        }
        return response()->json([
            'status' => true,
            'total' => $topping->count(),
            'topping' => $topping_obj,
        ], 200);
    }

    public function detail_topping($id) {

        $find_toppings = Topping::find($id);
        return response()->json([
            'status' => true,
            'topping' => $find_toppings
        ], 200);
    }

    public function promo() {

        $promos = Promo::all()->sortBy('created_at')->take(3);
        $promo_obj = [];
        foreach ($promos as $data) {
            array_push($promo_obj, $data);
        }
        return response()->json([
            'status' => true,
            'total' => $promos->count(),
            'promo' => $promo_obj,
        ], 200);
    }
}
