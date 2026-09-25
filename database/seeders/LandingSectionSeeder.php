<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingSection;

class LandingSectionSeeder extends Seeder
{
    public function run(): void
    {
        LandingSection::updateOrCreate(
            ['section_key' => 'hero'],
            [
                'title' => 'Start Your Training Journey',
                'body'  => 'Access free government-accredited livelihood training programs. Build your skills, grow your income, and transform your future with Dasmariñas City.',
            ]
        );

        LandingSection::updateOrCreate(
            ['section_key' => 'about'],
            [
                'title' => 'Our Story',
                'body'  => "Our livelihood training platform was created by a group of passionate students...\n\nAt the same time, the platform provides local government staff with centralized reporting tools...",
                'image_path' => 'images/ledipostory.png',
            ]
        );

        LandingSection::updateOrCreate(
            ['section_key' => 'announcement'],
            [
                'title' => 'CONGRATULATIONS',
                'body'  => 'to all our Dasmariñas City Training Center - Main Trainers for legitimately passing the Trainers Methodology 1 (TM1) Assessment!...',
                'image_path' => 'images/8.jpg',
            ]
        );
    }
}