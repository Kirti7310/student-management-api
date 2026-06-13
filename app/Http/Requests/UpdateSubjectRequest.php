<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
        $subject = $this->route('subject');
        $subjectId = is_object($subject) ? $subject->id : $subject;

        return [
            'name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50|unique:subjects,subject_code,' . $subjectId
        ];
    }
}
