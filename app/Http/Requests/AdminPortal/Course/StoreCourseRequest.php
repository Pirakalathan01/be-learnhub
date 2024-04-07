<?php

namespace App\Http\Requests\AdminPortal\Course;

use App\Enums\CourseType;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Course::class)->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'course_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Course::class)->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'description' => [
                'required',
                'string',
            ],
            'course_type' => [
                'required',
                'string',
                 Rule::in([CourseType::Engineering, CourseType::Finance, CourseType::InformationTechnology, CourseType::AcademicCourses]),
            ],
            'course_fee' => [
                'required',
                'numeric',
            ],

        ];
    }
}
