<?php

namespace App\Http\Requests\AdminPortal\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $student = $this->route('student');
        $this->merge(['id' => $student]);
        return [
            'id' => [
                'required',
                Rule::exists('users')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }

}
