<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /* Dashboard page */
    public function index() {
        return view('frontend.dashboard.index');
    }
}
