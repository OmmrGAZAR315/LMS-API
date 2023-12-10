<?php

namespace App\Traits;


use App\Course;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait CourseTrait
{
    public function validateCourse(Request $request)
    {
        return validator::make($request->all(), [
            'title' => 'required|unique:courses|max:16',
            'description' => 'required',
            'price' => 'required',
            'no_of_lectures' => 'required',
            'no_of_hours' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

}
