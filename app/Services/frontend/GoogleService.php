<?php
namespace App\Services\frontend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleService
{
    public $user;
    public function __construct(User $user) {
        $this->user= $user;
    }
    /*
    Google Login redirect 
    */
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }
    /*Google Login callback */
    public function callback() {
        $user = Socialite::driver('google')->user();
        $getUsers = $this->user->where('email', $user->getEmail())->first();
        if($getUsers) {
            $getUsers->update([
                'name'         => $user->getName(),
                'google_id'    => $user->getId(),
                'google_token' => $user->token,
            ]);
            Auth::login($getUsers);
            return redirect()->route('dashboard');
        }else {
            $in['name'] = $user->getName();
            $in['email'] = $user->getEmail();
            $in['password'] = encrypt($this->generatePassword(70));
            $in['google_id'] = $user->getId();
            $in['google_token'] = $user->token;
            $Newusers = $this->user->create($in);
           Auth::login($Newusers);
           return redirect()->route('dashboard');
        }
    }
    /* Generate random password */
    function generatePassword($length = 12) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()[]';
        return substr(str_shuffle($chars), 0, $length);
    }
}
