<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponser;

    public function login(LoginRequest $request)
    {
     
            $user = User::where('email', $request->email)->first();

            if (!$user) {
               return $this->errorResponse("User Not Found", 404);
            }
        
            if (!Hash::check($request->password, $user->password)) {
                return $this->errorResponse("Invalid Crendentails", 400);
            }
            
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('User-Token')->plainTextToken
            ]);
     
    }
}
