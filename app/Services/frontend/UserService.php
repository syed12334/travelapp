<?php

namespace App\Services\frontend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\frontend\UserRepository;

class UserService
{
    public $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    /* Store user data in data */
    public function storeUser($request) {
        $params['name'] = $request['name'];
        $params['email'] = $request['email'];
        $params['password'] = Hash::make($request['password']);
        $params['gender'] = isset($request['gender']) ? $request['gender'] : null;
        $user =  $this->userRepo->storeUser($params);
        if($user) {
            Auth::guard('web')->login($user);
            return redirect()->route('dashboard');
        }else {
            return back()->with('error','Error in registering user');
        }
    }
    /* Logout user */
    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
