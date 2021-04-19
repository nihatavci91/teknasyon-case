<?php

namespace App\Http\Controllers\Api;

use App\Business\AuthManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request, AuthManager $authManager)
    {
        $validated = $request->validate([
            'email' => 'email|required',
            'password' => 'string|required'
        ]);

        $token = $authManager->login($validated);

        return response_success(['token' => $token]);
    }

    public function register(Request $request, AuthManager $authManager)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'email' => 'email|required|unique:users,email',
            'password' => 'string|required|confirmed',
            'uid' => 'string|required',
            'app_id' => 'string|required',
            'language' => 'string|required',
            'operation_system' => 'string|required',
        ]);

        $token = $authManager->register($validated);

        return response_success(['token' => $token],'success',200);
    }
}
