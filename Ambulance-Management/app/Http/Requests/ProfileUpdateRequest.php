<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Enums\DoctorType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'date_of_birth'=>['required', 'date'],
            'gender'=>['required', 'string','max:255'],
            'phone_number' => ['required', 'regex:/^[0-9]{9}$/'],
            'type_of_doctor' => ['required', 'string', Rule::in(DoctorType::cases())],
        ];
    }
}
