<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Load index page
     */
    public function index()
    {
        // Load View
        return view('dashboard-admin');
    }
}
