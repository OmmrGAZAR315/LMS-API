<?php

namespace App\Traits;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Facades\Validator;

trait UserTrait
{
    public function userValidation($request, $update = null)
    {
        $email = ['required', 'email'];
        if ($update == null)
            $email [] = 'unique:users';

        $validator = validator::make($request->all(), [
            'first_name' => ['required', 'max:12'],
            'last_name' => ['required', 'max:12'],
            'email' => $email,
            'password' => ['required', 'min:3', 'confirmed'],
            'role' => 'required',
        ]);
        return $validator;
    }

    public function loginValidation($request)
    {
        $validator = validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        return $validator;
    }

    public function createUser($request)
    {
        $validator = $this->userValidation($request);
        if ($validator->fails())
            return $this->apiResponse(['error' => $validator->errors()], 422);

        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());
        return $this->apiResponse(['message' => 'User created successfully', 'data' => new UserResource($user)], 201);
    }
}
