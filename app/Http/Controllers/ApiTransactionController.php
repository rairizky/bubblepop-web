<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ApiTransactionController extends Controller
{
    public function tr_finish($iduser) {
        $get_user = User::find($iduser);
        $all_transaction = Order::all()->where('user_id', $get_user->id)->where('status', 'finish')->sortByDesc('created_at');
        $tr_obj = [];
        foreach ($all_transaction as $item) {
            array_push($tr_obj, $item);
        }

        return response()->json([
            'status' => true,
            'total' => $all_transaction->count(),
            'transaction' => $tr_obj
        ], 200);
    }

    public function tr_pending($iduser) {
        $get_user = User::find($iduser);
        $transaction_pending = Order::where('user_id', $get_user->id)->where('status', 'pending')->first();

        return response()->json([
            'status' => true,
            'transaction' => $transaction_pending
        ], 200);
    }
    
    public function addMenuToCart(Request $request, $iduser) {

        $get_user = User::find($iduser);

        // validate
        if ($request->get('size') == null && $request->get('mount') == null) {
            return response()->json([
                'status' => false,
                'message' => "size and mount can't be blank"
            ], 200);
        } elseif ($request->get('size') == null) {
            return response()->json([
                'status' => false,
                'message' => "size can't be blank"
            ], 200);
        } elseif ($request->get('mount') == null) {
            return response()->json([
                'status' => false,
                'message' => "mount can't be blank"
            ], 200);
        }

        // check user has cart
        $current_tr = Order::where('user_id', $get_user->id)->where('status', 'pending')->first();
        if ($current_tr) {
            // branching price
            $get_price = '';
            $find_menu = Menu::find($request->get('menu_id'));
            if ($request->get('size') == "M") {
                $get_price = $find_menu->price_m;
            } elseif ($request->get('size') == "L") {
                $get_price = $find_menu->price_l;
            }

            // check has current request menu
            $check_order_menu = Detail::where('order_id', $current_tr->id)->where('menu_id', $request->menu_id)->where('size', $request->size)->first();
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
                        return response()->json([
                            'status' => true,
                            'message' => 'Sukses update menu!',
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Gagal update menu!',
                        ], 200);
                    }
                }
            } else {
                $post = Detail::create([
                    'order_id' => $current_tr->id,
                    'menu_id' => $request->get('menu_id'),
                    'mount' => $request->get('mount'),
                    'size' => $request->get('size'),
                    'price' => $get_price,
                ]);

                if ($post) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Sukses tambah menu!',
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gagal tambah menu!',
                    ], 200);
                }
            }

        } else {
            // cart blank
            $post = Order::create([
                'name' => $get_user->name,
                'user_id' => $get_user->id,
                'status' => 'pending',
            ]);
    
            if ($post) {
                $order_id = $post->id;
                // branching price
                $get_price = '';
                $find_menu = Menu::find($request->get('menu_id'));
                if ($request->get('size') == "M") {
                    $get_price = $find_menu->price_m;
                } elseif ($request->get('size') == "L") {
                    $get_price = $find_menu->price_l;
                }

                // check has current request menu
                $check_order_menu = Detail::where('order_id', $order_id)->where('menu_id', $request->menu_id)->where('size', $request->size)->first();
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
                            return response()->json([
                                'status' => true,
                                'message' => 'Sukses update menu!',
                            ], 200);
                        } else {
                            return response()->json([
                                'status' => false,
                                'message' => 'Gagal update menu!',
                            ], 200);
                        }
                    }
                } else {
                    $post = Detail::create([
                        'order_id' => $order_id,
                        'menu_id' => $request->get('menu_id'),
                        'mount' => $request->get('mount'),
                        'size' => $request->get('size'),
                        'price' => $get_price,
                    ]);

                    if ($post) {
                        return response()->json([
                            'status' => true,
                            'message' => 'Sukses tambah menu!',
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Gagal tambah menu!',
                        ], 200);
                    }
                }
            }
        }

        
    }
}
