<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Services\DatabaseServices\PatientDB;
use App\Services\DatabaseServices\UserDB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(StorePatientRequest $request)
    {

        $user = UserDB::create($request->except('password_confirmation'));
        $patient = PatientDB::create(['user_id' => $user->id]);
        $patient->load('user');
           
        $patient->user->token = $user->createToken($user->name)->plainTextToken;
        $user->assignRole('patient');

        return $this->sendSuccess(['patient' => new PatientResource($patient)], 'user created successfully');

    }

    public function login(LoginRequest $request)
    {
        $user = UserDB::findByEmail($request->email);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->sendError('email or password are not correct', 402);
        }
        $user->token = $user->createToken($user->name)->plainTextToken;

        return $this->sendSuccess(new UserResource($user), 'Logged in successfully');
    }

    public function logout(Request $request)
    {
        /** @var App/Model */
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return $this->sendSuccess(null, 'logged out successfully');
    }
}
