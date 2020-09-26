<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PanelUsersController extends Controller
{
    
    public function index() {

        $users = User::all()->where('role', '!=', 'superadmin')->where('role', '!=', 'user');

        return view('layouts.panel.page.users.index', compact('users'));
    }

    public function add() {

        return view('layouts.panel.page.users.add');
    }

    public function storeUsers(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $post = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => $request->get('role'),
        ]);

        if ($post) {
            return redirect()->route('panel.users.index')->with('success', 'Success created users!');
        } else {
            return back();
        }
    }

    public function deleteUsers($id) {

        $user = User::find($id);
        $profile = $user->profile();
        $profileItem = $user->profile;

        if (file_exists(public_path("uploads/profile/{$profileItem->image}"))) {
            // remove old img
            unlink(public_path("uploads/profile/{$profileItem->image}"));
        }
        $profile->delete();
        $user->delete();

        return redirect()->route('panel.users.index')->with('success', 'Success deleted users!');
    }

}
