<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\frontend\LoginService;
class LoginController extends Controller
{
    public $loginList;
    public function __construct(LoginService $logd) {
        $this->loginList = $logd;
    }
    /* Login page */
    public function index() {
        return view('frontend.login');
    }
    /* Login list */
    public function login(Request $res) {
        return $this->loginList->getLogin($res->all());
    }
}
