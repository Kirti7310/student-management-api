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
            ],
            [
                'name' => 'Jojo ',
                'email' => 'jojo@example.com',
                'phone' => '9123456780',
                'course' => 'MCA',
                'age' => 24,
            ]
        ];

        foreach ($students as $studentData) {
            Student::updateOrCreate(
                ['email' => $studentData['email']],
                $studentData
            );
        }
    }
}
