<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Topping;
use Illuminate\Http\Request;

class PanelProductController extends Controller
{
    
    public function indexMenu() {

        $menus = Menu::all();

        return view('layouts.panel.page.product.menu.index', compact('menus'));
    }

    public function addMenu() {

        $categories = Category::all()->where('name', '!=' , 'topping');

        return view('layouts.panel.page.product.menu.add', compact('categories'));
    }

    public function storeMenu(Request $request) {

        $request->validate([
            'name' => 'required|unique:menus',
            'image' => 'required|mimes:jpg,png,jpeg',
            'price_m' => 'required|numeric|min:1',
            'price_l' => 'required|numeric|min:1',
            'category' => 'required',
            'description' => 'required',
            'status' => 'required|in:available,notavailable',
        ]);

        $file = $request->file('image');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $fileName.'_'.time().'.'.$file->getClientOriginalExtension();

        $post = Menu::create([
            'name' => $request->get('name'),
            'image' => $fileName,
            'price_m' => $request->get('price_m'),
            'price_l' => $request->get('price_l'),
            'category_id' => $request->get('category'),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
        ]);

        if ($post) {
            $file->move(public_path("uploads/menu/{$post->id}/"), $fileName);
            return redirect()->route('panel.product.index.menu')->with('success', 'Success created menu');
        } else {
            return back();
        }
    }

    public function editMenu($id) {

        $menu = Menu::find($id);
        $categories = Category::all()->where('name', '!=', 'topping');

        return view('layouts.panel.page.product.menu.edit', compact('menu', 'categories'));
    }

    public function updateMenu(Request $request, $id) {

        // proccess update
        $menu = Menu::find($id);

        // get before id path
        $getId = Menu::find($id);

        if ($request->hasFile('image')) {
            
            $request->validate([
                'name' => 'required|unique:menus,name,'.$menu->id,
                'image' => 'mimes:jpg,png,jpeg',
                'price_m' => 'required|numeric|min:1',
                'price_l' => 'required|numeric|min:1',
                'category' => 'required',
                'description' => 'required',
                'status' => 'required|in:available,notavailable',
            ]);

            $file = $request->file('image');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName.'_'.time().'.'.$file->getClientOriginalExtension();

            $up = $menu->update([
                'name' => $request->get('name'),
                'image' => $fileName,
                'price_m' => $request->get('price_m'),
                'price_l' => $request->get('price_l'),
                'category_id' => $request->get('category'),
                'description' => $request->get('description'),
                'status' => $request->get('status'),
            ]);

            if ($up) {
                if (file_exists(public_path("uploads/menu/{$getId->id}/{$getId->image}"))) {
                    // remove old img
                    unlink(public_path("uploads/menu/{$getId->id}/{$getId->image}"));
                }

                $file->move(public_path("uploads/menu/{$getId->id}/"), $fileName);
                return redirect()->route('panel.product.index.menu')->with('success', 'Menu updated');
            } else {
                return back();
            }
        } else {
            $request->validate([
                'name' => 'required|unique:menus,name,'.$menu->id,
                'price_m' => 'required|numeric|min:1',
                'price_l' => 'required|numeric|min:1',
                'category' => 'required',
                'description' => 'required',
                'status' => 'required|in:available,notavailable',
            ]);

            $up = $menu->update([
                'name' => $request->get('name'),
                'price_m' => $request->get('price_m'),
                'price_l' => $request->get('price_l'),
                'category_id' => $request->get('category'),
                'description' => $request->get('description'),
                'status' => $request->get('status'),
            ]);

            if ($up) {
                
                return redirect()->route('panel.product.index.menu')->with('success', 'Menu updated');
            } else {
                return back();
            }
        }
    }

    public function deleteMenu($id) {

        $find = Menu::find($id);

        if (file_exists(public_path("uploads/menu/{$find->id}/{$find->image}"))) {
            // remove old img
            unlink(public_path("uploads/menu/{$find->id}/{$find->image}"));
        }

        $del = $find->delete();

        if($del) {
            return redirect()->route('panel.product.index.menu')->with('success', 'Success delete menu');
        }
    }

    public function indexTopping() {

        $toppings = Topping::all();

        return view('layouts.panel.page.product.topping.index', compact('toppings'));
    }

    public function addTopping() {

        return view('layouts.panel.page.product.topping.add');
    }

    public function storeTopping(Request $request) {

        $request->validate([
            'name' => 'required|unique:toppings',
            'image' => 'required|mimes:jpg,png,jpeg',
            'price' => 'required|numeric|min:1',
            'description' => 'required',
            'status' => 'required|in:available,notavailable',
        ]);

        $file = $request->file('image');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $fileName.'_'.time().'.'.$file->getClientOriginalExtension();

        $getTopping = Category::where('name', 'topping')->first();

        $post = Topping::create([
            'name' => $request->get('name'),
            'image' => $fileName,
            'price' => $request->get('price'),
            'category_id' => $getTopping->id,
            'description' => $request->get('description'),
            'status' => $request->get('status'),
        ]);

        if ($post) {
            $file->move(public_path("uploads/topping/{$post->id}/"), $fileName);
            return redirect()->route('panel.product.index.topping')->with('success', 'Success created topping');
        } else {
            return back();
        }
    }

    public function editTopping($id) {

        $topping = Topping::find($id);
        $getTopping = Category::where('name', 'topping')->first();

        return view('layouts.panel.page.product.topping.edit', compact('topping'));
    }

    public function updateTopping(Request $request, $id) {

        // proccess update
        $topping = Topping::find($id);

        // get before id path
        $getId = Topping::find($id);

        $getTopping = Category::where('name', 'topping')->first();

        if ($request->hasFile('image')) {
            
            $request->validate([
                'name' => 'required|unique:toppings,name,'.$topping->id,
                'image' => 'mimes:jpg,png,jpeg',
                'price' => 'required|numeric|min:1',
                'description' => 'required',
                'status' => 'required|in:available,notavailable',
            ]);

            $file = $request->file('image');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName.'_'.time().'.'.$file->getClientOriginalExtension();

            $up = $topping->update([
                'name' => $request->get('name'),
                'image' => $fileName,
                'price' => $request->get('price'),
                'category_id' => $getTopping->id,
                'description' => $request->get('description'),
                'status' => $request->get('status'),
            ]);

            if ($up) {
                if (file_exists(public_path("uploads/topping/{$getId->id}/{$getId->image}"))) {
                    // remove old img
                    unlink(public_path("uploads/topping/{$getId->id}/{$getId->image}"));
                }

                $file->move(public_path("uploads/topping/{$getId->id}/"), $fileName);
                return redirect()->route('panel.product.index.topping')->with('success', 'Topping updated');
            } else {
                return back();
            }
        } else {
            $request->validate([
                'name' => 'required|unique:toppings,name,'.$topping->id,
                'price' => 'required|numeric|min:1',
                'description' => 'required',
                'status' => 'required|in:available,notavailable',
            ]);

            $up = $topping->update([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'category_id' => $getTopping->id,
                'description' => $request->get('description'),
                'status' => $request->get('status'),
            ]);

            if ($up) {
                
                return redirect()->route('panel.product.index.topping')->with('success', 'Topping updated');
            } else {
                return back();
            }
        }
    }

    public function deleteTopping($id) {

        $find = Topping::find($id);

        if (file_exists(public_path("uploads/topping/{$find->id}/{$find->image}"))) {
            // remove old img
            unlink(public_path("uploads/topping/{$find->id}/{$find->image}"));
        }

        $del = $find->delete();

        if($del) {
            return redirect()->route('panel.product.index.topping')->with('success', 'Success delete topping');
        }
    }
}
