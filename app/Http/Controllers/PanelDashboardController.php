<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelDashboardController extends Controller
{
    
    public function index() {
        
        return view('layouts.panel.page.dashboard.index');
    }
}
