<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelUsersController extends Controller
{
    
    public function index() {

        return view('layouts.panel.page.users.index');
    }

    public function add() {

        return view('layouts.panel.page.users.add');
    }

}
