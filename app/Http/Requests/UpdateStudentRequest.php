<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     */
    public function rules(): array
    {
        $student = $this->route('student');
        $studentId = is_object($student) ? $student->id : $student;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $studentId,
            'phone' => 'required|string|max:20',
            'course' => 'required|string|max:50',
            'age' => 'required|integer|min:18|max:30',
            'subject_id' => 'nullable|array',
            'subject_id.*' => 'exists:subjects,id'
        ];
    }
}
