<?php

namespace App\Http\Requests\AdminPortal\Enrollment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $enrollment = $this->route('enrollment');
        $this->merge(['id' => $enrollment]);
        return [
            'id' => [
                'required',
                Rule::exists('enrollments')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }

}
