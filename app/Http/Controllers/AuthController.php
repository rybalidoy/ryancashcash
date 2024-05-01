<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(AuthRequest $request, User $user) {
        try {
            $authenticatedUser = $user->authenticate($request->validated());
            if(! $authenticatedUser) {
                return response()->json(['message' => 'Email address or password is invalid']);
            }

            $existingToken = $authenticatedUser->tokens->first();

            if($existingToken) {
                // Revoke token
                $existingToken->delete();
            }

            // Include roles
            $roleName = $authenticatedUser->roles->first()->name;
            $token = $authenticatedUser->createToken('user_auth')->plainTextToken;

            $data = [
                'token' => $token,
                'role' => $roleName,
                'email' => $authenticatedUser->email,
            ];

            return response()->json($data, 200);
        } catch(\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function logout(Request $request) {
        $token = str_replace('Bearer','',$request->header('Authorization'));
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => 'User logged out'], 200);
    }
}
