<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'course' => 'required|string|max:50',
            'age' => 'required|integer|min:18|max:30',
            'gender' => 'required|string|in:male,female,other',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'city' => 'required|string|max:100',
            'blood_group' => 'required|string',
            'subject_id' => 'nullable|array',
            'subject_id.*' => 'exists:subjects,id'
        ];
    }
}
