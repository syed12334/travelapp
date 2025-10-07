<?php

namespace App\Services\frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\frontend\LoginRepository;


class LoginService
{
     public $login;
    public function __construct(LoginRepository $login)
    {
        $this->login = $login;
    }
    /* Login */
    public function getLogin($request) {
       $validate =$this->validateLogin($request);
       if ($validate['status'] =="false") {
             $results = [
                'status'  => 422,
                'errors'  => $validate['errors'],
            ];
            return response()->json($results);
        }else {
            $credentails['email'] = $request['email'];
            $credentails['password'] = $request['password'];
            $response = $this->authValidate($credentails);
            return response()->json($response);
        }
    }
     /* Validate input */
    public function validateLogin($userRequest) {
            $rules['email'] = ['required','email','regex:/(.+)@(.+)\.(.+)/i'];
            $rules['password'] ="required";
            $messages['password.required'] = "Please enter password";
            $messages['email.required'] = "Please enter email id";
            $messages['email.regex'] = "Please enter valid emailid";
            $validator = Validator::make($userRequest, $rules,$messages);
            if ($validator->fails()) {
                $result = [
                    'status'  => "false",
                    'errors'  => $validator->errors(),
                ];
                return $result;
            }  
            else {
                $result = [
                    'status'  => "true",
                ];
                return $result;
            }
    }
    /* Auth validate */
    public function authValidate($loginCredentials) {
        if (Auth::guard('web')->attempt($loginCredentials)) {
             $result = [
                    'status'  => "true",
                    'msg'  => "Login successfull",
                    'data'=>Auth::guard('web')->user()
             ];
             return $result;
        }else {
            $result = [
                    'status'  => "false",
                    'msg'  => "Invalidate login credentials",
             ];
             return $result;
        }
    }
    /* Logout */
    public function logout()
    {
        Auth::guard('web')->logout(); 
        return redirect("/login");
    }
}
