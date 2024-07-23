<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Validator};

class LoginController extends Controller
{    
    /**
     * Store token
     *
     * @param  mixed $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['Invalid Data', $validator->errors()->toArray()]);
        } else {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();

                if ($user->is_admin) {
                    $token = $user->createToken('authToken')->plainTextToken;

                    return response()->json(['token' => $token], 200);
                } else {
                    Auth::logout();

                    return response()->json(['error' => 'You are not authorized to access this Api'], 401);
                }
            } else {
                return response()->json(['success' => 'Invalid credentials'], 200);
            }

            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}