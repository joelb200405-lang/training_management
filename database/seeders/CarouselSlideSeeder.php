<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarouselSlide;

class CarouselSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            ['image_path' => 'images/1.jpg', 'title' => 'Community Event 1', 'caption' => 'Dasmariñas City Training Center', 'sort_order' => 1],
            ['image_path' => 'images/2.jpg', 'title' => 'Community Event 2', 'caption' => 'Dasmariñas City Training Center', 'sort_order' => 2],
            ['image_path' => 'images/3.jpg', 'title' => 'Community Event 3', 'caption' => 'Dasmariñas City Training Center', 'sort_order' => 3],
            ['image_path' => 'images/4.jpg', 'title' => 'Community Event 4', 'caption' => 'Dasmariñas City Training Center', 'sort_order' => 4],
            ['image_path' => 'images/5.jpg', 'title' => 'Community Event 5', 'caption' => 'Dasmariñas City Training Center', 'sort_order' => 5],
        ];

        foreach ($slides as $slide) {
            CarouselSlide::updateOrCreate(
                ['image_path' => $slide['image_path']],
                $slide
            );
        }
    }
}