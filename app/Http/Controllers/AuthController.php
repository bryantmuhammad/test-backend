<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $response = create_reponse();

        try {
            $user = User::create($request->validated());
        } catch (\Exception $e) {
            return response()->json($response, $response->status_code);
        }

        $response->status_code  = 200;
        $response->status       = 'success';
        $response->message      = 'Register account sucsess';
        $response->data         = $user;

        return response()->json($response, $response->status_code);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required'],
        ]);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $response = create_reponse();
        $response->status       = 'success';
        $response->message      = 'Success Login';
        $response->status_code  = 200;
        $response->data = [
            'token' => $token
        ];

        return response()->json($response, $response->status_code);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
