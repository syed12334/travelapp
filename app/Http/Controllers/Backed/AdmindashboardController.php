<?php

namespace App\Http\Controllers\Backed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdmindashboardController extends Controller
{
    public function __construct() {

    }
    /* Dashboard page */
    public function index() {
        return view('backed.dashboard');
    }
}
