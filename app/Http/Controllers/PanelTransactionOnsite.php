<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Detail;
use App\Models\Extra;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Topping;
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

        // get path and all menu
        $menus = Menu::paginate(6);
        $current_customer = Order::where('cashier', auth()->user()->id)->where('status', 'pending')->where('id', $id)->first();

        // list order
        $order_detail = Order::find($id)->list_order;

        // get total cart item
        $sum_item = $order_detail->sum('mount');

        // list extra
        $extra_order_detail = Order::find($id)->list_extra;

        // get total price
        $get_list = $order_detail;
        $total = 0;
        foreach ($get_list as $data) {
            $mount = $data->mount;
            $price = $data->price;
            $count = $mount*$price;
            $total += $count;
        }

        foreach ($extra_order_detail as $data) {
            $get_topping = Topping::find($data->topping_id);
            $total += $get_topping->price;
        }
        // return dd($total);

        return view('layouts.panel.page.transaction.onsite.cartmenu', compact('menus', 'current_customer', 'order_detail', 'sum_item', 'total'));
    }

    public function searchMenu($id, Request $request) {

        $get_query = $request->get('search');

        // get path and all menu
        $menus = Menu::where('name', 'like', "%".$get_query."%")->paginate(6);
        $menus->appends($request->only('search'));
        $current_customer = Order::where('cashier', auth()->user()->id)->where('status', 'pending')->where('id', $id)->first();

        // list order
        $order_detail = Order::find($id)->list_order;

        // get total cart item
        $sum_item = $order_detail->sum('mount');

        // list extra
        $extra_order_detail = Order::find($id)->list_extra;

        // get total price
        $get_list = $order_detail;
        $total = 0;
        foreach ($get_list as $data) {
            $mount = $data->mount;
            $price = $data->price;
            $count = $mount*$price;
            $total += $count;
        }

        foreach ($extra_order_detail as $data) {
            $get_topping = Topping::find($data->topping_id);
            $total += $get_topping->price;
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
        $check_order_menu = Detail::where('order_id', $id)->where('menu_id', $request->menu_id)->where('size', $request->size)->first();
        if ($check_order_menu != null) {
            if ($check_order_menu->size == $request->get('size')) {

                // find and get current order list
                $get_current_menu = Detail::find($check_order_menu->id);
                $current_mount = $get_current_menu->mount;
                $updated_mount = $current_mount+$request->get('mount');

                // update mount
                $up = $get_current_menu->update([
                    'mount' => $updated_mount,
                ]);
                if ($up) {
                    return redirect()->route('panel.transaction.cartmenu.onsite', $id)->with('success', 'Menu updated');
                } else {
                    return back();
                }
            }
        } else {
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
    }

    public function extraTopping($id, $menulistid) {

        $current_customer = Order::where('cashier', auth()->user()->id)->where('status', 'pending')->where('id', $id)->first();
        $get_order_menu = Detail::where('order_id', $id)->where('id', $menulistid)->firstOrFail();

        // get menu desc
        $menu_data = Menu::find($get_order_menu->menu_id);

        $get_mount = $get_order_menu->mount;
        $get_price = $get_order_menu->price;

        // all topping
        $get_toppings = Topping::all()->where('status', 'available');

        // order menu has topping?
        $order_detail_topping = $get_order_menu->extra_item;
        // return dd($order_detail_topping->extra_for == 1);

        return view('layouts.panel.page.transaction.onsite.extratopping', compact('get_order_menu', 'current_customer', 'menu_data', 'get_mount', 'get_price', 'get_toppings', 'order_detail_topping'));
    }

    public function storeExtraTopping($id, $menulistid, Request $request) {
        
        if ($request->get('topping') == null) {
            return redirect()->back()->with('error', "extra topping can't null");
        }

        $current_customer = Order::where('cashier', auth()->user()->id)->where('status', 'pending')->where('id', $id)->first();
        $get_order_menu = Detail::where('order_id', $id)->where('id', $menulistid)->firstOrFail();

        foreach ($request->get('topping') as $topping) {
            Extra::create([
                'order_id' => $current_customer->id,
                'detail_id' => $get_order_menu->id,
                'topping_id' => $topping,
                'extra_for' => $request->get('extra_id')
            ]);
        }

        return redirect()->route('panel.transaction.storeextratopping.onsite', [$current_customer->id, $get_order_menu->id])->with('success', 'extra added');
    }

    public function updateExtraTopping($id, $menulistid, Request $request) {

        $current_customer = Order::where('cashier', auth()->user()->id)->where('status', 'pending')->where('id', $id)->first();
        $get_order_menu = Detail::where('order_id', $id)->where('id', $menulistid)->firstOrFail();
        $find_extra = $get_order_menu->extra_item();

        if ($request->get('topping') == null) {
            if ($find_extra->exists()) {
                $find_extra->where('extra_for', $request->get('extra_id'))->delete();
            }

            return redirect()->route('panel.transaction.storeextratopping.onsite', [$current_customer->id, $get_order_menu->id])->with('success', 'extra deleted');
        } else {
            if ($find_extra->exists()) {
                $find_extra->where('extra_for', $request->get('extra_id'))->delete();
            }
    
            foreach ($request->get('topping') as $topping) {
                Extra::create([
                    'order_id' => $current_customer->id,
                    'detail_id' => $get_order_menu->id,
                    'topping_id' => $topping,
                    'extra_for' => $request->get('extra_id')
                ]);
            }
    
            return redirect()->route('panel.transaction.storeextratopping.onsite', [$current_customer->id, $get_order_menu->id])->with('success', 'extra updated');
        }
    }

    public function deleteMenuOrder($id, $idmenu) {

        $find_order_menu = Detail::where('id', $idmenu)->firstOrFail();
        $find_extra = $find_order_menu->extra_item();
        
        if ($find_extra->exists()) {
            $find_extra->delete();
        }
        $find_order_menu->delete();
        return redirect()->route('panel.transaction.cartmenu.onsite', $id)->with('success', 'Menu deleted');
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
