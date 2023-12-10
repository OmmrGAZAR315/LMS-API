<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded=[];

    public function course()
    {
        return $this->belongsTo(User::class);
    }
}
