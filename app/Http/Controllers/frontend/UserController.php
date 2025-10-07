<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\frontend\UserService;
use App\Http\Requests\FrontUserRequest;
use App\Services\frontend\GoogleService;

class UserController extends Controller
{
    public $userService;
    public $GoogleService;
    public function __construct(UserService $userServices,GoogleService $googleservice) {
        $this->userService = $userServices;
        $this->GoogleService = $googleservice;
    }
      /* User registration form */
    public function register() {
        return view('frontend/register');
    }
    /* Store user in database */
    public function storeuser(Request $request) {
         return $this->userService->storeUser($request->all());
    }
    /* Logout User */
    public function logout() {
        return $this->userService->logout();
    }
    /* Google register redirect */
    public function googleLoginRedirect() {
        return $this->GoogleService->redirect();
    }
    /* Login callback data */
    public function googleredirectcallback() {
        return $this->GoogleService->callback();
    }
}
