<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course_tbl;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title'       => 'Baking (Cake, Bread, Pastries)',
                'description' => 'Learn the fundamentals of baking including cakes, breads, and pastries for personal and commercial use.',
                'objectives'  => 'Develop baking skills for livelihood and entrepreneurship.',
                'sector'      => 'Livelihood',
                'duration'    => '5 days',
                'schedule'    => 'Mon-Tue 10:00 AM',
                'location'    => 'Barangay Burol Main Hall, Dasmariñas, Cavite',
                'slots'       => 20,
                'status'      => 'active',
                'trainer_id'  => null,
            ],
            [
                'title'       => 'Street Food and Snacks',
                'description' => 'Master the art of preparing popular Filipino street food and snacks for business.',
                'objectives'  => 'Equip learners with skills to start a street food business.',
                'sector'      => 'Livelihood',
                'duration'    => '3 days',
                'schedule'    => 'Mon-Tue 10:00 AM',
                'location'    => 'LEDIPO Main, City Hall Compound',
                'slots'       => 25,
                'status'      => 'active',
                'trainer_id'  => null,
            ],
            [
                'title'       => 'Basic Sewing',
                'description' => 'Learn basic sewing techniques including stitching, hemming, and garment construction.',
                'objectives'  => 'Provide practical sewing skills for livelihood opportunities.',
                'sector'      => 'Livelihood',
                'duration'    => '7 days',
                'schedule'    => 'Wed-Thu 10:00 AM',
                'location'    => 'Barangay Burol Main Hall, Dasmariñas, Cavite',
                'slots'       => 15,
                'status'      => 'active',
                'trainer_id'  => null,
            ],
            [
                'title'       => 'Candle Making',
                'description' => 'Learn how to make scented and decorative candles for personal use and business.',
                'objectives'  => 'Develop candle making skills for small business opportunities.',
                'sector'      => 'Livelihood',
                'duration'    => '3 days',
                'schedule'    => 'Wed-Thu 10:00 AM',
                'location'    => 'LEDIPO Main, City Hall Compound',
                'slots'       => 20,
                'status'      => 'active',
                'trainer_id'  => null,
            ],
            [
                'title'       => 'Computer Literacy',
                'description' => 'Basic computer skills including MS Office, internet browsing, and email communication.',
                'objectives'  => 'Equip learners with essential digital skills for employment.',
                'sector'      => 'ICT',
                'duration'    => '10 days',
                'schedule'    => 'Mon-Fri 8:00 AM',
                'location'    => 'LEDIPO Main, City Hall Compound',
                'slots'       => 30,
                'status'      => 'active',
                'trainer_id'  => null,
            ],
            [
                'title'       => 'Carpentry & Woodworks',
                'description' => 'Learn carpentry skills including furniture making, wood finishing, and construction basics.',
                'objectives'  => 'Develop carpentry skills for construction and livelihood.',
                'sector'      => 'Construction',
                'duration'    => '15 days',
                'schedule'    => 'Mon-Fri 8:00 AM',
                'location'    => 'Barangay Burol Main Hall, Dasmariñas, Cavite',
                'slots'       => 20,
                'status'      => 'active',
                'trainer_id'  => null,
            ],
        ];

        foreach ($courses as $course) {
            Course_tbl::create($course);
        }
    }
}
