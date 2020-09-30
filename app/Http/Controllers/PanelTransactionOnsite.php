<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class PanelTransactionOnsite extends Controller
{

    public function addInvoice() {

        $current_tr = Order::where('cashier', auth()->user()->id)->where('status', 'pending')->first();
        if ($current_tr) {
            return redirect()->route('panel.transaction.cartmenu.onsite', $current_tr->id);
        }

        return view('layouts.panel.page.transaction.onsite.index');
    }

    public function storeInvoice(Request $request) {

        $request->validate([
            'name' => 'required'
        ]);

        $post = Order::create([
            'name' => $request->get('name'),
            'cashier' => auth()->user()->id,
            'status' => 'pending',
        ]);

        if ($post) {
            return redirect()->route('panel.transaction.cartmenu.onsite', $post->id);
        } else {
            return back();
        }

    }

    public function cartMenu($id) {

        $menus = Menu::all();
        $current_customer = Order::where('cashier', auth()->user()->id)->where('status', 'pending')->where('id', $id)->first();

        return view('layouts.panel.page.transaction.onsite.cartmenu', compact('menus', 'current_customer'));
    }

    public function storeCart(Request $request, $id) {

        if ($request->get('size') == null && $request->get('mount') == null) {
            return redirect()->back()->with('error', "size and mount can't blank");
        } elseif ($request->get('size') == null) {
            return redirect()->back()->with('error', "size can't blank");
        } elseif ($request->get('mount') == null) {
            return redirect()->back()->with('error', "mount can't blank");
        }

    }
}
