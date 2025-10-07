<?php

namespace App\Services\frontend;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
class GithubService
{
    public $user;
    public function __construct(User $user)
    {
        $this->user= $user;
    }
    /* Login redirect */
    public function redirect() {
        return Socialite::driver('github')->redirect();
    }
    /* Login callback */
    public function callback() {
        $user = Socialite::driver('github')->user();
        $getUsers = $this->user->where(['email'=>$user->getEmail()])->get();
        if(count($getUsers) >0) {

        }else {

        }
    }
}
