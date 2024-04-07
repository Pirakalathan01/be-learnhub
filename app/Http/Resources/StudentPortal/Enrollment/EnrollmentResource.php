<?php

namespace App\Http\Resources\StudentPortal\Enrollment;


use App\Http\Resources\StudentPortal\Course\CourseResource;
use App\Http\Resources\StudentPortal\Student\StudentResource;
use Carbon\Carbon;
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
            'user' => new StudentResource($this->user),
            'course' => new CourseResource($this->course),
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d')
        ];
    }

}
