<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PanelPromoController extends Controller
{
    
    public function indexPromo() {

        $promos = Promo::all();

        return view('layouts.panel.page.promo.index', compact('promos'));
    }

    public function addPromo() {


        return view('layouts.panel.page.promo.add');
    }

    public function storePromo(Request $request) {

        $request->validate([
            'title' => 'required|unique:promos',
            'image' => 'required|mimes:jpg,png,jpeg',
            'description' => 'required',
            'promo_start' => 'required|date',
            'promo_end' => 'required|date|after_or_equal:promo_start'
        ]);

        $file = $request->file('image');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $fileName.'_'.time().'.'.$file->getClientOriginalExtension();

        $post = Promo::create([
            'title' => $request->get('title'),
            'image' => $fileName,
            'description' => $request->get('description'),
            'promo_start' => $request->get('promo_start'),
            'promo_end' => $request->get('promo_end')
        ]);

        if ($post) {
            $file->move(public_path("uploads/promo/{$post->id}/"), $fileName);
            return redirect()->route('panel.promo.index')->with('success', 'Success created promo');
        } else {
            return back();
        }
    }

    public function editPromo($id) {

        $get_promo = Promo::find($id);

        return view('layouts.panel.page.promo.edit', compact('get_promo'));
    }

    public function updatePromo($id, Request $request) {

        // proccess update
        $promo = Promo::find($id);

        // get before id path
        $getId = Promo::find($id);

        if ($request->hasFile('image')) {
            
            $request->validate([
                'title' => 'required|unique:promos,title,'.$promo->id,
                'image' => 'mimes:jpg,png,jpeg',
                'description' => 'required',
                'promo_start' => 'required|date',
                'promo_end' => 'required|date|after_or_equal:promo_start',
            ]);

            $file = $request->file('image');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName.'_'.time().'.'.$file->getClientOriginalExtension();

            $up = $promo->update([
                'title' => $request->get('title'),
                'image' => $fileName,
                'description' => $request->get('description'),
                'promo_start' => $request->get('promo_start'),
                'promo_end' => $request->get('promo_end'),
            ]);

            if ($up) {
                if (file_exists(public_path("uploads/promo/{$getId->id}/{$getId->image}"))) {
                    // remove old img
                    unlink(public_path("uploads/promo/{$getId->id}/{$getId->image}"));
                }

                $file->move(public_path("uploads/promo/{$getId->id}/"), $fileName);
                return redirect()->route('panel.promo.index')->with('success', 'Promo updated');
            } else {
                return back();
            }
        } else {
            
            $request->validate([
                'title' => 'required|unique:promos,title,'.$promo->id,
                'description' => 'required',
                'promo_start' => 'required|date',
                'promo_end' => 'required|date|after_or_equal:promo_start',
            ]);

            $up = $promo->update([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'promo_start' => $request->get('promo_start'),
                'promo_end' => $request->get('promo_end')
            ]);

            if ($up) {
                return redirect()->route('panel.promo.index')->with('success', 'Promo updated');
            } else {
                return back();
            }
        }
    }

    public function deletePromo($id) {

        $find_promo = Promo::find($id);

        if (file_exists(public_path("uploads/promo/{$find_promo->id}/{$find_promo->image}"))) {
            // remove old img
            unlink(public_path("uploads/promo/{$find_promo->id}/{$find_promo->image}"));
        }

        $del = $find_promo->delete();
        if ($del) {
            return redirect()->route('panel.promo.index')->with('success', 'Success deleted promo');
        } else {
            return back();
        }
    }
}
