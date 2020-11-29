<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Poin;
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
        $transaction_pending = Order::all()->where('user_id', $get_user->id)->where('status', 'pending');
        $tr_pending_obj = [];
        foreach ($transaction_pending as $data) {
            array_push($tr_pending_obj, $data);
        }

        return response()->json([
            'status' => true,
            'total' => $transaction_pending->count(),
            'transaction' => $tr_pending_obj
        ], 200);
    }

    public function tr_cart($iduser) {
        $get_cart_user = Order::where('user_id', $iduser)->where('status', 'cart')->first();
        if ($get_cart_user == null) {
            return response()->json([
                'status' => true,
                'total' => 0,
                'transaction' => []
            ], 200);
        } else {
            $get_order_detail_user = $get_cart_user->list_order;
            $total = 0;
            foreach ($get_order_detail_user as $data) {
                $mount = $data->mount;
                $price = $data->price;
                $count = $mount*$price;
                $total += $count;
            }
            $tr_detail_obj = [];
            foreach ($get_order_detail_user as $data) {
                array_push($tr_detail_obj, $data);
            }
            return response()->json([
                'status' => true,
                'tprice' => $total,
                'total' => $get_order_detail_user->count(),
                'transaction' => $tr_detail_obj
            ], 200);
        }

        return response()->json([
            'status' => true,
            'transaction' => "List menu na yeuh"
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
        $current_tr = Order::where('user_id', $get_user->id)->where('status', 'cart')->first();
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
                'status' => 'cart',
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

    public function checkoutCart(Request $request, $iduser) {
        $get_current_menu = Order::where('user_id', $iduser)->where('status', 'cart');
        $up = $get_current_menu->update([
            'total' => $request->get('total'),
            'status' => 'pending'
        ]);
        
        if ($up) {
            return response()->json([
                'status' => true,
                'message' => 'Checkout berhasil!',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal checkout!',
            ], 200);
        }
    }

    public function detailPending($iduser, $idtr) {
        $get_cart_user = Order::where('id', $idtr)->where('user_id', $iduser)->where('status', 'pending')->first();
        if ($get_cart_user) {
            if ($get_cart_user == null) {
                return response()->json([
                    'status' => true,
                    'id' => $get_cart_user->id,
                    'name' => $get_cart_user->name,
                    'user_id' => $get_cart_user->user_id,
                    'cashier' => $get_cart_user->cashier,
                    'total' => $get_cart_user->total,
                    'paid' => $get_cart_user->paid,
                    'status' => $get_cart_user->status,
                    'created_at' => $get_cart_user->created_at,
                    'updated_at' => $get_cart_user->update_at,
                    'menu' => []
                ], 200);
            } else {
                $get_order_detail_user = $get_cart_user->list_order;
                $total = 0;
                foreach ($get_order_detail_user as $data) {
                    $mount = $data->mount;
                    $price = $data->price;
                    $count = $mount*$price;
                    $total += $count;
                }
                $tr_detail_obj = [];
                foreach ($get_order_detail_user as $data) {
                    array_push($tr_detail_obj, $data);
                }
                return response()->json([
                    'status' => true,
                    'id' => $get_cart_user->id,
                    'name' => $get_cart_user->name,
                    'user_id' => $get_cart_user->user_id,
                    'cashier' => $get_cart_user->cashier,
                    'total' => $get_cart_user->total,
                    'paid' => $get_cart_user->paid,
                    'status' => $get_cart_user->status,
                    'created_at' => $get_cart_user->created_at,
                    'updated_at' => $get_cart_user->update_at,
                    'transaction' => $tr_detail_obj
                ], 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Transaksi Pending kosong!',
            ], 200);
        }
    }

    public function detailFinish($iduser, $idtr) {
        $get_cart_user = Order::where('id', $idtr)->where('user_id', $iduser)->where('status', 'finish')->first();
        if ($get_cart_user) {
            if ($get_cart_user == null) {
                return response()->json([
                    'status' => true,
                    'id' => $get_cart_user->id,
                    'name' => $get_cart_user->name,
                    'user_id' => $get_cart_user->user_id,
                    'cashier' => $get_cart_user->cashier,
                    'total' => $get_cart_user->total,
                    'paid' => $get_cart_user->paid,
                    'status' => $get_cart_user->status,
                    'created_at' => $get_cart_user->created_at,
                    'updated_at' => $get_cart_user->update_at,
                    'menu' => []
                ], 200);
            } else {
                $get_order_detail_user = $get_cart_user->list_order;
                $total = 0;
                foreach ($get_order_detail_user as $data) {
                    $mount = $data->mount;
                    $price = $data->price;
                    $count = $mount*$price;
                    $total += $count;
                }
                $tr_detail_obj = [];
                foreach ($get_order_detail_user as $data) {
                    array_push($tr_detail_obj, $data);
                }
                return response()->json([
                    'status' => true,
                    'id' => $get_cart_user->id,
                    'name' => $get_cart_user->name,
                    'user_id' => $get_cart_user->user_id,
                    'cashier' => $get_cart_user->cashier,
                    'total' => $get_cart_user->total,
                    'paid' => $get_cart_user->paid,
                    'status' => $get_cart_user->status,
                    'created_at' => $get_cart_user->created_at,
                    'updated_at' => $get_cart_user->update_at,
                    'transaction' => $tr_detail_obj
                ], 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Transaksi Finish kosong!',
            ], 200);
        }
    }

    public function getCashier($iduser, $idtr) {
        $find = Order::where('id', $idtr)->where('user_id', $iduser)->where('status', 'finish')->first();
        $get_name_cashier = User::find($find->cashier);
        return response()->json([
            'status' => true,
            'message' => $get_name_cashier->name,
        ], 200);
    }

    public function poinUser($iduser) {
        $find = Poin::where('user_id', $iduser)->first();
        return response()->json([
            'status' => true,
            'message' => $find->total,
        ], 200);
    }
}
