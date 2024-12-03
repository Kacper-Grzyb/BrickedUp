<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditDashboardLayoutController extends Controller
{
    public function index() {
        return view('edit-dashboard');
    }
}
