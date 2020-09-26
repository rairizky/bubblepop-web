<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelProductController extends Controller
{
    
    public function index() {

        return view('layouts.panel.page.product.index');
    }

    public function add() {

        return view('layouts.panel.page.product.add');
    }

    public function storeProduct(Request $request) {

        
    }
}
