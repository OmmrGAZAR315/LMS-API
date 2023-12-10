<?php

namespace App\Traits;

trait Api
{
    public function apiResponse($json, $status)
    {
        return response($json, $status);
    }

}
