<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //try to implment seeder without raw queries
        //existing data without affecting .
        //run a foreach loop.
        $students = [
            [
                'name' => 'Kirti Karapurkar',
                'email' => 'kirti@example.com',
                'phone' => '9876543210',
                'course' => 'BCA',
                'age' => 22,
                'gender' => 'female',
            ],
            [
                'name' => 'Jojo ',
                'email' => 'jojo@example.com',
                'phone' => '9123456780',
                'course' => 'MCA',
                'age' => 24,
                'gender' => 'male',
            ]
        ];

        foreach ($students as $studentData) {
            $student = Student::where('email', $studentData['email'])->first();

            if ($student && $student->profile) {
                $student->update([
                    'name' => $studentData['name'],
                    'phone' => $studentData['phone'],
                    'course' => $studentData['course'],
                    'age' => $studentData['age'],
                ]);
                $student->profile->update([
                    'gender' => $studentData['gender']
                ]);
            } else {
                $profile = \App\Models\Profile::create([
                    'gender' => $studentData['gender']
                ]);

                Student::updateOrCreate(
                    ['email' => $studentData['email']],
                    [
                        'name' => $studentData['name'],
                        'phone' => $studentData['phone'],
                        'course' => $studentData['course'],
                        'age' => $studentData['age'],
                        'profile_id' => $profile->id,
                    ]
                );
            }
        }
    }
}
