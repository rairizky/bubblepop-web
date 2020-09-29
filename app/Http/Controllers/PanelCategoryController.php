<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PanelCategoryController extends Controller
{
    
    public function index() {

        $categories = Category::all()->where('name', '!=', 'topping');

        return view('layouts.panel.page.category.index', compact('categories'));
    }

    public function add() {

        return view('layouts.panel.page.category.add');
    }

    public function storeCategory(Request $request) {

        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $post = Category::create([
            'name' => $request->get('name')
        ]);

        if ($post) {
            return redirect()->route('panel.category.index')->with('success', 'Category created!');
        } else {
            return back();
        }
    }

    public function editCategory($id) {

        $find = Category::find($id);

        return view('layouts.panel.page.category.edit', compact('find'));
    }

    public function updateCategory($id, Request $request) {

        $find = Category::find($id);

        $request->validate([
            'name' => 'required|unique:categories,name,'.$find->id,
        ]);

        $up = $find->update([
            'name' => $request->get('name')
        ]);

        if ($up) {
            return redirect()->route('panel.category.index')->with('success', 'Category updated!');
        } else {
            return back();
        }
    }

    public function deleteCategory($id) {

        $find = Category::find($id);

        $del = $find->delete();

        if ($del) {
            return redirect()->route('panel.category.index')->with('success', 'Success delete category');
        }
    }
}
