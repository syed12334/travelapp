<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\frontend\UserService;
use App\Http\Requests\FrontUserRequest;

class HomeController extends Controller
{
    public $userService;
    public function __construct(UserService $userServices) {
        $this->userService = $userServices;
    }
    /* Homepage */
    public function index() {
        return view('index');
    }
}
