<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelTransactionOnsite extends Controller
{

    public function addInvoice() {

        return view('layouts.panel.page.transaction.onsite.content.index');
    }

    public function cartMenu() {

        return view('layouts.panel.page.transaction.onsite.content.cartmenu');
    }
}
