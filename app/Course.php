<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function foo\func;

class Course extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'image', 'no_of_hours', 'no_of_lectures'
    ];

    public function enrollment()
    {
        return $this->belongsToMany(User::class, "Enrollment", "course_id", "user_id");
    }

    public function lessons($lesson_name = null)
    {
        if ($lesson_name == null)
            return $this->hasMany(Lesson::class);

        return $this->hasMany(Lesson::class)->where('name', '=', $lesson_name);
    }
}
