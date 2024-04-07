<?php

namespace App\Http\Resources\StudentPortal\Course;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 */
class CourseResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_code' => $this->course_code,
            'course_name' => $this->course_name,
            'description' => $this->description,
            'course_type' => $this->course_type,
            'course_fee' => $this->course_fee,
        ];
    }

}
