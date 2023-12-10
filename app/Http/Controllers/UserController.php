<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Traits\Api;
use App\Traits\UserTrait;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Api, UserTrait;

    public function index()
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Supervisor')
            return new UserCollection(User::all());

        elseif (auth()->user()->role == 'Teacher') {
            //get all students in courses that the teacher is enrolled in
            $collection = collect($this->getSpecificUsers("Student"));

            return new UserCollection($collection);
        } elseif (auth()->user()->role == 'Student') {
            return new UserCollection($this->getSpecificUsers("Teacher"));
        } else {
            return $this->apiResponse(['error' => 'Unauthorized'], 401);
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Supervisor') {
            if ($user)
                return $this->apiResponse(['error' => 'User not found'], 404);
            return new UserResource($user);


        } elseif (auth()->user()->role == 'Teacher') {
            if ($user)
                return $this->apiResponse(['error' => 'User not found'], 404);

            $collection = collect($this->getSpecificUsers("Student"));
            if ($collection->contains($user))
                return new UserResource($user);


        } elseif (auth()->user()->role == 'Student') {
            if ($user)
                return $this->apiResponse(['error' => 'User not found'], 404);

            $collection = collect($this->getSpecificUsers("Teacher"));
            if ($collection->contains($user))
                return new UserResource($user);

        }
        return $this->apiResponse(['error' => 'Unauthorized'], 401);

    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 'Admin')
            return $this->createUser($request);
        else
            return $this->apiResponse(['error' => 'Unauthorized'], 401);
    }


    public function update(Request $request, $user_id)
    {
        //redundant code
        if (auth()->user()->role != 'Admin')
            return $this->apiResponse(['error' => 'Unauthorized'], 401);

        $validator = $this->userValidation($request, true);
        if ($validator->fails())
            return $this->apiResponse(['error' => $validator->errors()], 422);

        $request->merge(['password' => bcrypt($request->password)]);

        if (!$user = User::find($user_id))
            return $this->apiResponse(['error' => 'User not found'], 404);

        $user->update($request->all());
        return $this->apiResponse(['message' => 'User Updated successfully', 'data' => new UserResource($user)], 201);
    }

    public function destroy($id)
    {
        //redundant code
        if (auth()->user()->role != 'Admin')
            return $this->apiResponse(['error' => 'Unauthorized'], 401);

        if (!$user = User::find($id))
            return $this->apiResponse(['error' => 'User not found'], 404);

        if ($user->enrollment()->count() > 0)
            return $this->apiResponse([
                'error' => 'User has enrollments',
                'solution' => 'you can delete use has enrollments by using force delete'
            ], 422);

        $user->delete();
        return $this->apiResponse(['message' => 'User deleted successfully'], 200);
    }

    public function forceDestroy($id)
    {
        //redundant code
        if (auth()->user()->role != 'Admin')
            return $this->apiResponse(['error' => 'Unauthorized'], 401);

        if (!$user = User::find($id))
            return $this->apiResponse(['error' => 'User not found'], 404);

        if ($user->enrollment()->count() == 0)
            $jsonResponse['error'] = "User has no enrollments already";
        else
            $user->enrollment()->detach();
        $user->delete();
        $jsonResponse['message'] = "User deleted successfully";
        return $this->apiResponse($jsonResponse, 200);
    }

    public function getSpecificUsers($role)
    {
        $users = [];
        auth()->user()->enrollment()->pluck('course_id')
            ->each(function ($course_id) use (&$users, $role) {
                Course::find($course_id)->enrollment()->pluck('user_id')
                    ->each(function ($user_id) use (&$users, $role) {
                        if ($user_id != auth()->user()->id
                            && User::find($user_id)->role == $role) {
                            $users[] = User::find($user_id);
                        }
                    });
            });
        return collect($users);
    }
}
