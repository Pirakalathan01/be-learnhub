<?php

namespace App\Http\Requests\AdminPortal\Admin;

use App\Enums\Gender;
use App\Enums\Title;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
        $admin = $this->route('admin');
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
