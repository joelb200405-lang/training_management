@extends('student.layout')

@section('title', 'All Courses')

@section('content')

  <style>
    .courses-page-wrap {
      padding: 40px 50px;
    }

    .courses-header {
      margin-bottom: 30px;
    }

    .courses-header h3 {
      margin-top: 10px;
    }

    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 24px;
    }

    .course-card {
      display: flex;
      flex-direction: column;
      border: 1px solid #ddd;
      border-radius: 12px;
      overflow: hidden;
      background: white;
      transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .course-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 20px rgba(2, 86, 40, 0.12);
    }

    .course-thumbnail {
      height: 140px;
      flex-shrink: 0;
      background: #025628;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .course-thumbnail i {
      font-size: 60px;
      color: rgba(255, 255, 255, 0.6);
    }

    .course-body {
      padding: 16px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .sector-badge {
      background: #F7EE17;
      color: #025628;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
      align-self: flex-start;
    }

    .course-body h5 {
      margin-top: 10px;
      font-weight: 700;
      color: #025628;
    }

    .course-body .description {
      font-size: 13px;
      color: #888;
      margin-bottom: 10px;
      flex: 1;
    }

    .course-meta {
      font-size: 12px;
      color: #555;
      margin-bottom: 14px;
    }

    .course-meta p {
      margin: 4px 0;
    }

    .btn-view-course,
    .btn-locked {
      display: block;
      text-align: center;
      padding: 10px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      margin-top: auto;
      text-decoration: none;
    }

    .btn-view-course {
      background: #025628;
      color: white;
    }

    .btn-view-course:hover {
      background: #013d1c;
      color: white;
    }

    .btn-locked {
      background: #ccc;
      color: #666;
    }

    .empty-state {
      color: #888;
      grid-column: 1 / -1;
    }

    @media (max-width: 480px) {
      .courses-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <div class="container-fluid p-0">
    <div class="courses-page-wrap">

      {{-- HEADER --}}
      <div class="courses-header">
        <div class="text-1">
          <div class="box"></div>
          <p>Available Programs</p>
        </div>
        <h3>All Courses</h3>
      </div>

      {{-- COURSES GRID --}}
      <div class="courses-grid">
        @forelse($courses as $course)
          <div class="course-card">

            {{-- COURSE IMAGE/ICON --}}
            <div class="course-thumbnail">
              <i class="fa-solid fa-book"></i>
            </div>

            {{-- COURSE INFO --}}
            <div class="course-body">
              <span class="sector-badge">{{ $course->sector }}</span>
              <h5>{{ $course->title }}</h5>
              <p class="description">{{ Str::limit($course->description, 80) }}
              </p>

              <div class="course-meta">
                <p><i class="fa fa-clock"></i> {{ $course->duration }}</p>
                <p><i class="fa fa-calendar"></i> {{ $course->schedule }}</p>
                <p><i class="fa fa-location-dot"></i> {{ $course->location }}</p>
                <p><i class="fa fa-users"></i> {{ $course->available_slots }}
                  slots</p>
              </div>

              @php
                $isEnrolled = in_array($course->id, $enrolledCourseIds);
                $isLocked = $atLimit && !$isEnrolled;
              @endphp

              @if ($isLocked)
                <div class="btn-locked"><i class="fa fa-lock"></i> Limit Reached
                </div>
              @else
                <a href="{{ route('course.detail', $course->id) }}"
                  class="btn-view-course">
                  View Course
                </a>
              @endif
            </div>
          </div>
        @empty
          <p class="empty-state">No courses available at the moment.</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection
