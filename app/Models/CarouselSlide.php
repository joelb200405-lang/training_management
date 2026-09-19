<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarouselSlide extends Model
{
    protected $fillable = ['image_path', 'title', 'caption', 'sort_order'];
}