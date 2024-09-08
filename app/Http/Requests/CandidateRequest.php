<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'university_place' => 'nullable',
            'last_work' => 'nullable',
            'birthday' => 'nullable',
            'positive_skills' => 'nullable',
            'language_id' =>'nullable',
            'marital_state' => 'nullable',
            'gender' => 'required',
            'is_student' => 'nullable',
            'app_id' =>'nullable',
            'voice_path' => 'nullable|file|mimes:ogg,mp3,wav',
            'photo_path' => 'nullable|file|mimes:jpg,jpeg,png'
        ];
    }
}
