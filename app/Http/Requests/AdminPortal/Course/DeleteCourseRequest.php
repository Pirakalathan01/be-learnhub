<?php

namespace App\Http\Requests\AdminPortal\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $course = $this->route('course');
        $this->merge(['id' => $course]);
        return [
            'id' => [
                'required',
                Rule::exists('courses')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }

}
