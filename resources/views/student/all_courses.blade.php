@extends('student.layout')

@section('title', 'All Courses')

@section('content')
<div class="container-fluid p-0">
    <div style="padding: 40px 50px;">

        {{-- HEADER --}}
        <div style="margin-bottom: 30px;">
            <div class="text-1">
                <div class="box"></div>
                <p>Available Programs</p>
            </div>
            <h3 style="margin-top: 10px;">All Courses</h3>
        </div>

        {{-- COURSES GRID --}}
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            @forelse($courses as $course)
            <div style="border: 1px solid #ddd; border-radius: 12px; overflow: hidden; background: white;">
                
                {{-- COURSE IMAGE/ICON --}}
                <div style="height: 140px; background: #025628; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-book" style="font-size: 60px; color: rgba(255,255,255,0.6);"></i>
                </div>

                {{-- COURSE INFO --}}
                <div style="padding: 16px;">
                    <span style="background: #F7EE17; color: #025628; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;">
                        {{ $course->sector }}
                    </span>
                    <h5 style="margin-top: 10px; font-weight: 700; color: #025628;">{{ $course->title }}</h5>
                    <p style="font-size: 13px; color: #888; margin-bottom: 10px;">{{ Str::limit($course->description, 80) }}</p>
                    
                    <div style="font-size: 12px; color: #555; margin-bottom: 14px;">
                        <p style="margin: 4px 0;"><i class="fa fa-clock"></i> {{ $course->duration }}</p>
                        <p style="margin: 4px 0;"><i class="fa fa-calendar"></i> {{ $course->schedule }}</p>
                        <p style="margin: 4px 0;"><i class="fa fa-location-dot"></i> {{ $course->location }}</p>
                        <p style="margin: 4px 0;"><i class="fa fa-users"></i> {{ $course->slots }} slots</p>
                    </div>

                    <a href="{{ route('course.detail', $course->id) }}" 
                       style="display: block; text-align: center; background: #025628; color: white; padding: 10px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">
                        View Course
                    </a>
                </div>
            </div>
            @empty
                <p style="color: #888;">No courses available at the moment.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection