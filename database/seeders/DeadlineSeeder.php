<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deadline_tbl;

class DeadlineSeeder extends Seeder
{
    public function run(): void
    {
        $deadlines = [
            [
                'title'       => 'Baking Final Project Submission',
                'description' => 'Submit your final baking project for evaluation.',
                'due_date'    => now()->addDays(3),
                'course_id'   => 1,
                'type'        => 'submission',
            ],
            [
                'title'       => 'Basic Sewing Assessment',
                'description' => 'Written and practical assessment for Basic Sewing.',
                'due_date'    => now()->addDays(5),
                'course_id'   => 3,
                'type'        => 'assessment',
            ],
            [
                'title'       => 'Graduation Requirements Clearance',
                'description' => 'Submit all required documents for graduation clearance.',
                'due_date'    => now()->addDays(7),
                'course_id'   => null,
                'type'        => 'graduation',
            ],
            [
                'title'       => 'Computer Literacy Final Exam',
                'description' => 'Final examination for Computer Literacy course.',
                'due_date'    => now()->addDays(10),
                'course_id'   => 5,
                'type'        => 'assessment',
            ],
            [
                'title'       => 'Candle Making Product Showcase',
                'description' => 'Present your candle making products for final evaluation.',
                'due_date'    => now()->addDays(14),
                'course_id'   => 4,
                'type'        => 'submission',
            ],
        ];

        foreach ($deadlines as $deadline) {
            Deadline_tbl::create($deadline);
        }
    }
}