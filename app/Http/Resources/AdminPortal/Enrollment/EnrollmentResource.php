<?php

namespace App\Http\Resources\AdminPortal\Enrollment;

use App\Http\Resources\AdminPortal\Course\CourseResource;
use App\Http\Resources\AdminPortal\Student\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 */
class EnrollmentResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'course_id' => $this->course_id,
            'user' => new StudentResource($this->user),
            'course' => new CourseResource($this->course),
            'status' => $this->status,
        ];
    }

}
