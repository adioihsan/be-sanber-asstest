<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\User;

class AuthController extends Controller
{
    public function register(UserRequest $request){
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('passowrd'),
            'password' => Hash::make($data['password']),
        ]);

    }
}
