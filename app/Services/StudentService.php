<?php

namespace App\Services;

use App\Models\Student;

class StudentService
{
    /**
     */
    public function registerStudent(array $data): Student
    {
        $student = Student::create([
            'name'   => $data['name'],
            'email'  => $data['email'],
            'phone'  => $data['phone'],
            'course' => $data['course'],
            'age'    => $data['age'],
        ]);

        $student->profile()->create([
            'address'       => $data['address'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'city'          => $data['city'],
            'blood_group'   => $data['blood_group'],
        ]);

        if (!empty($data['subject_id'])) {
            $student->subjects()->attach($data['subject_id']);
        }

        return $student->load(['profile', 'attendances', 'subjects']);
    }

    /**
     */
    public function updateStudent(Student $student, array $data): Student
    {
        $student->update([
            'name'   => $data['name'],
            'email'  => $data['email'],
            'phone'  => $data['phone'],
            'course' => $data['course'],
            'age'    => $data['age'],
        ]);

        if (isset($data['subject_id'])) {
            $student->subjects()->sync($data['subject_id']);
        }

        return $student->load(['profile', 'attendances', 'subjects']);
    }
}
