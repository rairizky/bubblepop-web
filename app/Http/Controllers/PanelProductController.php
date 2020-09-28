<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PanelProductController extends Controller
{
    
    public function indexMenu() {

        return view('layouts.panel.page.product.menu.index');
    }

    public function addMenu() {

        $categories = Category::all()->where('name', '!=' , 'topping');

        return view('layouts.panel.page.product.menu.add', compact('categories'));
    }

    public function storeMenu(Request $request) {

        $request->validate([
            'name' => 'required|',
            'image' => 'required|mimes:jpg,png,jpeg',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'status' => 'required|in:available,notavailable',
        ]);
        
        return back();
    }
}
