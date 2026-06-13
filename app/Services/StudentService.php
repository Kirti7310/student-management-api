<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Profile;

class StudentService
{
    /**
     */
    public function registerStudent(array $data): Student
    {
        $profile = Profile::create([
            'gender'        => $data['gender'],
        ]);

        $student = Student::create([
            'profile_id' => $profile->id,
            'name'       => $data['name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'course'     => $data['course'],
            'age'        => $data['age'],
        ]);

        if (!empty($data['subject_id'])) {
            $student->subjects()->attach($data['subject_id']);
        }

        return $student->load(['profile', 'attendances', 'subjects']);//controller is return response
    }

    /**
     * enter some details
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

        if (isset($data['gender'])) {
            if ($student->profile) {
                $student->profile->update(['gender' => $data['gender']]);
            } else {
                $profile = Profile::create(['gender' => $data['gender']]);
                $student->update(['profile_id' => $profile->id]);
            }
        }

        if (isset($data['subject_id'])) {
            $student->subjects()->sync($data['subject_id']);
        }

        return $student->load(['profile', 'attendances', 'subjects']);
    }
}
