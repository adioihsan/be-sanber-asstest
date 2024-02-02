<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login(UserRequest $request){
        $credentials = $request->validated();
        if (auth()->attempt($credentials)) {
            $token = $request->user()->createToken("credential_token")->plainTextToken;
            return response()->api_ok("Login success",["token"=>$token]);
        }else{
            return response()->api_fail("Username or Password didnt match",[],401);
        }
    }
}
