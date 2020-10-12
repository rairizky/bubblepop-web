<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Promo;
use App\Models\Topping;
use Illuminate\Http\Request;

class ApiFrontController extends Controller
{

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

    public function category_menu($id) {
        $categories = Category::where('id', $id)->where('name', '!=', 'topping')->first();
        $category_menu = $categories->menu;
        $category_menu_obj = [];
        foreach ($category_menu as $data) {
            array_push($category_menu_obj, $data);
        }
        return response()->json([
            'status' => true,
            'category' => $categories->name,
            'total' => $category_menu->count(),
            'menu' => $category_menu_obj,
        ], 200);
    }

    public function category_topping($id) {
        $categories = Category::where('id', $id)->where('name', 'topping')->first();
        $category_menu = $categories->topping;
        $category_menu_obj = [];
        foreach ($category_menu as $data) {
            array_push($category_menu_obj, $data);
        }
        return response()->json([
            'status' => true,
            'category' => $categories->name,
            'total' => $category_menu->count(),
            'topping' => $category_menu_obj,
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
