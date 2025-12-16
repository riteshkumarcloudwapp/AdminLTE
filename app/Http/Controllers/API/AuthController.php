<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use OpenApi\Annotations as OA;


class AuthController extends Controller
{


    /**
     * @OA\Post(
     *     path="/api/user/login",
     *     summary="Login User",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="admin@gmail.com"),
     *             @OA\Property(property="password", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login success"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    // Login User
    public function loginUser(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid login details',
            'data' => null
        ], 401);
    }

    $user = Auth::user();

    // Generate token
    $token = $user->createToken('auth_token')->plainTextToken;
    

    return response()->json([
        'status'  => true,
        'message' => 'Login successful',
        'data'    => [
            'user' => [
                'id'            => $user->id,
                'name'          => $user->name,
                'email'         => $user->email,
                'profile_image' => $user->profile_image,
            ],
            'token' => $token
        ]
    ], 200);
}

    
}
