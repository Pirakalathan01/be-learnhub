<?php

namespace App\Http\Requests\AdminPortal\Student;

use App\Enums\Gender;
use App\Enums\Title;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreStudentRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                Rule::unique(User::class)->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'gender' => [
                'required',
                Rule::in([Gender::Male, Gender::Female]),
            ],
            'phone_number' => [
                'nullable',
                'numeric',
                'min_digits:10',
                Rule::unique(User::class)->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'password' => [
                'nullable',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed'
            ]

        ];
    }
}
