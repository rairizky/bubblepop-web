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

}
