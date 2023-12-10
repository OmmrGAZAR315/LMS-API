<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ID' => $this->id,
            'First Name' => $this->first_name,
            'Last Name' => $this->last_name,
            "Email"=>$this->email,
            'Course Enrolled'=>$this->enrollment->pluck('title')->implode(' '),
            "Password"=>$this->password,
            "Role"=>$this->role,
        ];
    }
}
