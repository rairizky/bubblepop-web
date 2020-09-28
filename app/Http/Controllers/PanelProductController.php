<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
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
                'name' => 'required|unique:menus,id,'.$menu->id,
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
                'name' => 'required|unique:menus,id,'.$menu->id,
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
}
