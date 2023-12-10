<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\LessonCollection;
use App\Http\Resources\LessonResource;
use App\Lesson;
use App\Traits\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    use Api;

    function index()
    {
        if (!auth()->check())
            return $this->apiResponse([
                'error' => 'not logged'
            ], 403);

        if (auth()->user()->role != "Admin" && auth()->user()->role != 'Teacher')
            return $this->apiResponse([
                'error' => 'not authorized'
            ], 401);

        return new LessonCollection(new LessonResource(Lesson::all()));

    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|unique:lessons|min:4',
            'course_id' => 'required|integer|exists:courses,id',
            'material_path' => 'sometimes'
        ]);
        if ($validator->fails())
            return $this->apiResponse([
                'error' => $validator->errors(),
            ], 401);

        $course = Course::find($request->course_id);

        if (!$request->filled('name'))
            $request->merge(['name' => $course->lessons()->count() + 1]);

        return $this->apiResponse([
            'message' => 'lesson created successfully',
            'data' => new LessonResource($course->lessons()->save(new Lesson($request->all()))),

        ], 200);
    }

    function upload(Request $request, $course_id, $lesson_id)
    {
        if (!auth()->check())
            return $this->apiResponse([
                'error' => 'not logged',
            ], 401);

        if (auth()->user()->role != "Admin" && auth()->user()->role != "Teacher")
            return $this->apiResponse([
                'error' => 'unauthorized',
            ], 402);

        $course = Course::find($course_id);
        if ($course == null)
            return $this->apiResponse([
                'error' => 'course not found',
            ], 404);

        $lesson = $course->lessons($lesson_id);

        if ($lesson == null)
            return $this->apiResponse([
                'error' => 'lesson not found',
            ], 404);


        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:ppt,pptx,pdf,doc,docx,xlsx',
        ]);
        if ($validator->fails())
            return $this->apiResponse([
                'error' => $validator->errors()
            ], 405);

        $file_name = $request->file('file')->getClientOriginalName();

        $course->lessons($lesson_id)->update([
            'material-path' =>
                $request->file('file')->storeAs('Files', $file_name)
        ]);

        return $this->apiResponse([
            'message' => 'file uploaded successfully',
            'data' => $course->lessons($lesson_id)->get(),
        ], 201);


    }
}
