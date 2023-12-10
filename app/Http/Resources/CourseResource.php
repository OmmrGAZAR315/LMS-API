<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ID' => $this->id,
            'Title' => $this->title,
            "Instructor's Names" => $this->enrollment->where('role', 'Teacher')->pluck('first_name')->implode(' '),
            "Student Names" => $this->enrollment->where('role', 'Student')->pluck('first_name')->implode(' '),
            'Description' => $this->description,

        ];
    }
}
