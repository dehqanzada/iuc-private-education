<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Student 1',
            ],
            [
                'name' => 'Student 2',
            ],
            [
                'name' => 'Student 3',
            ],
            [
                'name' => 'Student 4',
            ]
        ];

        foreach ($data ?? [] as $key => $value) {
            Student::create($value);
        }
    }
}
