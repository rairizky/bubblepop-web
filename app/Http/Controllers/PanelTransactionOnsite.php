<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

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

        // get path and all menu
        $menus = Menu::all();
        $current_customer = Order::where('cashier', auth()->user()->id)->where('status', 'pending')->where('id', $id)->first();

        // list order
        $order_detail = Order::find($id)->list_order;

        // get total cart item
        $sum_item = $order_detail->sum('mount');

        // get total price
        $get_list = $order_detail;
        $total = 0;
        foreach ($get_list as $data) {
            $mount = $data->mount;
            $price = $data->price;
            $count = $mount*$price;
            $total += $count;
        }
        // return dd($total);

        return view('layouts.panel.page.transaction.onsite.cartmenu', compact('menus', 'current_customer', 'order_detail', 'sum_item', 'total'));
    }

    public function storeCart(Request $request, $id) {

        if ($request->get('size') == null && $request->get('mount') == null) {
            return redirect()->back()->with('error', "size and mount can't be blank");
        } elseif ($request->get('size') == null) {
            return redirect()->back()->with('error', "size can't be blank");
        } elseif ($request->get('mount') == null) {
            return redirect()->back()->with('error', "mount can't be blank");
        }

        $get_price = '';
        $find_menu = Menu::find($request->get('menu_id'));
        if ($request->get('size') == "M") {
            $get_price = $find_menu->price_m;
        } elseif ($request->get('size') == "L") {
            $get_price = $find_menu->price_l;
        }

        // return dd($request->get('menu_id'), $request->get('mount'), $request->get('size'), $get_price);
        $post = Detail::create([
            'order_id' => $id,
            'menu_id' => $request->get('menu_id'),
            'mount' => $request->get('mount'),
            'size' => $request->get('size'),
            'price' => $get_price,
        ]);

        if ($post) {
            return redirect()->route('panel.transaction.cartmenu.onsite', $id)->with('success', 'Menu added');
        } else {
            return back();
        }
    }

    public function cancelOrder($id) {

        $get_order = Order::find($id);
        $get_detail_order = $get_order->list_order();

        if ($get_detail_order->exists()) {
            $get_detail_order->delete();
        }
        $get_order->delete();

        return redirect()->route('panel.transaction.addinvoice.onsite')->with('success', 'cancel order success');
    }
}
