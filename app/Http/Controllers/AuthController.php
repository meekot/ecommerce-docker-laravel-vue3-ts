<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
            'remember' => 'boolean'
        ]);


        $remember = $credentials['remember'] ?? false;
        
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return new JsonResponse([
                'message' => 'Email or password is incorrect'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->is_admin) {
            Auth::logout();
            return new JsonResponse([
                'message' => "You don't have permissions to authenticate as admin"
            ], Response::HTTP_FORBIDDEN);
        }

        $token = $user->createToken('main')->plainTextToken;

        return new JsonResponse([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function logout(): JsonResponse
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->tokens()->delete();

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function getUser(Request $request): JsonResponse
    {
        return new JsonResponse(new UserResource($request->user()));
    }
}
