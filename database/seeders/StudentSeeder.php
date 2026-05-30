<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('students')->insert([
            [
                'name' => 'Kirti Karapurkar',
                'email' => 'kirti@example.com',
                'phone' => '9876543210',
                'course' => 'BCA',
                 'age' => 22,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jojo ',
                'email' => 'jojo@example.com',
                'phone' => '9123456780',
                'course' => 'MCA',
                 'age' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ]);

    }
}
