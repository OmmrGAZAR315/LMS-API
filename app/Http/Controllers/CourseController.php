<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Lesson;
use App\Traits\Api;
use App\Traits\CourseTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    use CourseTrait, Api;

    public function index()
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Supervisor')
            return new CourseCollection(Course::all());


        return new CourseCollection(auth()->user()->enrollment->each(function ($enrollment) {
            return $enrollment->course;
        }));
    }

    public function show($id)
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Supervisor') {

            if (!$course = Course::find($id))
                return $this->apiResponse(['error' => 'Course not found'], 404);

            return new CourseResource($course);

        } elseif (auth()->user()->enrollment()->wherePivot('course_id', '=', $id)->exists()) {

            if (!$course = Course::find($id))
                return $this->apiResponse(['error' => 'Course not found'], 404);


            return new CourseResource($course);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->role != 'Admin')
            return $this->apiResponse(['error' => 'you are not allowed to create a course'], 401);

        $validate = $this->validateCourse($request);
        if ($validate->fails())
            return response()->json(['error' => $validate->errors()], 400);

        Course::create($request->all());
        return response()->json([
            'message' => 'Course created successfully',
            'data' => new CourseResource(Course::Latest()->first())
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role != 'Admin')
            return $this->apiResponse(['error' => 'you are not allowed to update a course'], 401);

        if (!$course = Course::find($id))
            return response()->json(['error' => 'Course not found'], 404);

        $validate = $this->validateCourse($request);
        if ($validate->fails())
            return response()->json(['error' => $validate->errors()], 400);
        else {
            $course->update($request->all());
            return response()->json(['message' => 'Course updated successfully'], 201);
        }
    }

    public
    function destroy($id)
    {
        if (auth()->user()->role != 'Admin')
            return $this->apiResponse(['error' => 'you are not allowed to delete a course'], 401);


        if (!$course = Course::find($id))
            return response()->json(['error' => 'Course not found'], 404);

        if ($course->enrollment()->count() > 0)

            return $this->apiResponse([
                'error' =>
                    "this course has users enrolled in it, you can not delete it",
                'solution' =>
                    'you can delete a course has users enrolled in it if you used force delete'
            ], 400);

        $course->delete();
        return $this->apiResponse(['message' => 'Course deleted successfully'], 200);

    }

    function forceDestroy($id)
    {
        if (auth()->user()->role != 'Admin')
            return $this->apiResponse(['error' => 'you are not allowed to delete a course'], 401);

        if (!$course = Course::find($id))
            return response()->json(['error' => 'Course not found'], 404);

        if ($course->enrollment()->count() == 0)
            $responseKey['alert'] = 'Course has no users enrolled in it';
        else
            $course->enrollment()->detach();

        $course->delete();
        $responseKey['message'] = 'Course deleted successfully';
        return $this->apiResponse($responseKey, 200);

    }

    function enroll($id, $user_id = null)
    {
        if ($user_id != null) {
            if (auth()->user()->role == 'Admin') {

                if (!$course = Course::find($id))
                    return $this->apiResponse(['error' => 'Course not found'], 404);

                if (!$user = User::find($user_id))
                    return $this->apiResponse(['error' => 'User not found'], 404);
                if ($user->enrollment()
                    ->wherePivot("course_id", '=', $course->id)->exists())
                    return $this->apiResponse(["error" => 'This user has been already enrolled in this course'], 401);

                $user->enrollment()->attach($course->id);
                return $this->apiResponse([
                    'message' =>
                        'he/she has enrolled in ' . $course->title . ' course'], 200);

            } elseif (auth()->user()->role == 'Supervisor') {

                //redundant code
                if (!$course = Course::find($id))
                    return $this->apiResponse(['error' => 'Course not found'], 404);


                //redundant code
                if (!$user = User::find($user_id))
                    return $this->apiResponse(['error' => 'User not found'], 404);

                if ($user->role != 'Teacher')
                    return $this->apiResponse(['error' => 'you are not to authorized for this action'], 401);

                if ($user->enrollment()
                    ->wherePivot("course_id", '=', $course->id)->exists())
                    return $this->apiResponse(["error" => 'This user has been already enrolled in this course'], 401);

                $user->enrollment()->attach($course->id);
                return $this->apiResponse([
                    'message' =>
                        'he/she has enrolled in ' . $course->title . ' course'], 200);

            } elseif (auth()->user()->role == 'Teacher') {

                if (!$course = Course::find($id))
                    return $this->apiResponse(['error' => 'Course not found'], 404);

                if (!$user = User::find($user_id))
                    return $this->apiResponse(['error' => 'User not found'], 404);

                if ($user->role != 'Student')
                    return $this->apiResponse(['error' => 'you are not to authorized for this action'], 401);

                if ($user->enrollment()
                    ->wherePivot("course_id", '=', $course->id)->exists())
                    return $this->apiResponse(["error" => 'This user has been already enrolled in this course'], 401);

                $user->enrollment()->attach($course->id);
                return $this->apiResponse([
                    'message' =>
                        'he/she has enrolled in ' . $course->title . ' course'], 200);

            }
        } else {
            if (auth()->user()->role == 'Admin') {

                //Redundant code
                if (!$course = Course::find($id))
                    return $this->apiResponse(['error' => 'Course not found'], 404);

                if (auth()->user()->enrollment()
                    ->wherePivot("course_id", '=', $course->id)->exists())
                    return $this->apiResponse(["error" => 'you have been already enrolled in this course'], 401);

                auth()->user()->enrollment()->attach($course->id);

                return $this->apiResponse([
                    'message' =>
                        'he/she has enrolled in ' . $course->title . ' course'], 200);

            }
        }
    }

    function unroll($course_id, $user_id = null)
    {

        if ($user_id != null) {
            if (auth()->user()->role == 'Admin') {

                if (!$course = Course::find($course_id))
                    return $this->apiResponse(['error' => 'Course not found'], 404);

                if (!$user = User::find($user_id))
                    return $this->apiResponse(['error' => 'User not found'], 404);

                if (!$user->enrollment()
                    ->wherePivot("course_id", '=', $course->id)->exists())
                    return $this->apiResponse(["error" => 'This user has not been enrolled in this course'], 401);

                $user->enrollment()->detach($course->id);
                return $this->apiResponse([
                    'message' =>
                        'he/she has unrolled from ' . $course->title . ' course'
                ], 200);


            } elseif (auth()->user()->role == 'Supervisor') {

                //redundant code
                if (!$course = Course::find($course_id))
                    return $this->apiResponse(['error' => 'Course not found'], 404);


                //redundant code
                if (!$user = User::find($user_id))
                    return $this->apiResponse(['error' => 'User not found'], 404);

                if ($user->role != 'Teacher')
                    return $this->apiResponse(['error' => 'you are not to authorized for this action'], 401);

                if (!$user->enrollment()
                    ->wherePivot("course_id", '=', $course->id)->exists())
                    return $this->apiResponse(["error" => 'This user has not been enrolled in this course'], 401);

                $user->enrollment()->detach($course->id);
                return $this->apiResponse([
                    'message' =>
                        'he/she has unrolled from ' . $course->title . ' course'
                ], 200);

            } elseif (auth()->user()->role == 'Teacher') {

                if (!$course = Course::find($course_id))
                    return $this->apiResponse(['error' => 'Course not found'], 404);

                if (!$user = User::find($user_id))
                    return $this->apiResponse(['error' => 'User not found'], 404);

                if ($user->role != 'Student')
                    return $this->apiResponse(['error' => 'you are not to authorized for this action'], 401);

                if (!$user->enrollment()
                    ->wherePivot("course_id", '=', $course->id)->exists())
                    return $this->apiResponse(["error" => 'This user has not been enrolled in this course'], 401);

                $user->enrollment()->detach($course->id);
                return $this->apiResponse([
                    'message' =>
                        'he/she has unrolled from ' . $course->title . ' course'
                ], 200);
            }
        } else {
            if (auth()->user()->role == 'Admin') {

                //Redundant code
                if (!$course = Course::find($course_id))
                    return $this->apiResponse(['error' => 'Course not found'], 404);

                if (!auth()->user()->enrollment()
                    ->wherePivot("course_id", '=', $course->id)->exists())
                    return $this->apiResponse(["error" => 'you have not been enrolled in this course'], 401);

                auth()->user()->enrollment()->detach($course->id);

                return $this->apiResponse([
                    'message' =>
                        'he/she has unrolled from ' . $course->title . ' course'
                ], 200);
            }
        }
    }
}
