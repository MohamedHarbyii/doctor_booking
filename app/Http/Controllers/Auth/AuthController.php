<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Routing\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Services\DatabaseServices\UserDB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {

        $user = UserDB::create($request->validated());

        $user->token = $user->createToken($user->name)->plainTextToken;
        $user->assignRole('patient');

        return $this->sendSuccess(['user' => new UserResource($user)], 'user created successfully');

    }
    public function login(LoginRequest $request) {
        $user=UserDB::findByEmail($request->email);
       
        if(!$user || !Hash::check($request->password,$user->password))
        {
          return $this->sendError('email or password are not correct',402);
        }
        $user->token=$user->createToken($user->name)->plainTextToken;
        return $this->sendSuccess(new UserResource($user),'Logged in successfully');
    }
    public function logout(Request $request) {
       /** @var App/Model */
        $user= $request->user();
        $user->currentAccessToken()->delete();
        return $this->sendSuccess(null,'logged out successfully');
    }
}
