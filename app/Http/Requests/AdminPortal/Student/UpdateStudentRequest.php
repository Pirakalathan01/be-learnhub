<?php

namespace App\Http\Requests\AdminPortal\Student;

use App\Enums\Gender;
use App\Enums\Title;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        $student = $this->route('student');
        return [
            'title' => [
                'required',
                Rule::in([Title::Mr, Title::Mrs, Title::Ms]),
            ],
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name' => [
                'required',
                'string',
                'max:255'
            ],
            'gender' => [
                'required',
                Rule::in([Gender::Male, Gender::Female]),
            ],
        ];
    }
}
