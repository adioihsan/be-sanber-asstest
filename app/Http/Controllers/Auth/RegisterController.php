<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(UserRequest $request){
        $user = User::create($request->validated());
        return response()->api_ok("Registration success",$user);
    }
}
