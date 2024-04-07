<?php

namespace App\Http\Requests\AdminPortal\Enrollment;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEnrollmentRequest extends FormRequest
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
        $enrollment = $this->route('enrollment');
        $this->merge(['id' => $enrollment]);
        return [
            'id' => [
                'required',
                Rule::exists('enrollments')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'status' => [
                'required',
                'string',
                Rule::in([Status::Enrolled,Status::Cancelled,Status::Completed]),
            ],
        ];
    }
}
