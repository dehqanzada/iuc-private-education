<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 10; $i++) {
            do {
                $studentId = rand(1, 4);
                $groupId = rand(1, 4);
                $resourceId = rand(1, 20);
                $exists = Exam::where('student_id', $studentId)
                    ->where('group_id', $groupId)
                    ->where('group_item_id', $resourceId)
                    ->exists();
            } while ($exists);
            Exam::create([
                'student_id' => $studentId,
                'group_id' => $groupId,
                'group_item_id' => $resourceId
            ]);
        }
    }
}
