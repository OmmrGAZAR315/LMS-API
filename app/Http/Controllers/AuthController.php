<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Traits\Api;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AuthController extends Controller
{
    use UserTrait, Api;

    public function __construct()
    {
//        $this->middleware('auth:api', ['expect' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
       return $this->createUser($request);
    }

    public function login(Request $request)
    {
        $validator = $this->loginValidation($request);
        if ($validator->fails())
            return $this->apiResponse(['error' => $validator->errors()], 422);

        $credentials = $request->only(['email', 'password']);
        if (!$token = auth()->attempt($credentials))
            return $this->apiResponse(['error' => "Unauthorized"], 401);
        return $this->respondWithToken($token);

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function me()
    {
        return $this->apiResponse(['data' => new UserResource(auth()->user())], 200);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout()
    {
        auth()->logout();
        return $this->apiResponse(['message' => 'Successfully logged out'], 200);
    }
}
