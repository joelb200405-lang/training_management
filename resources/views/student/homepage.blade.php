@extends('student.layout')

@section('title', 'Home')

@section('content')
    <div class="container-fluid p-0">
       

        <main>
            <div class="parent-box">
                <img src="{{ asset('images/sulongna.jpg') }}" alt="Sulongna">
            </div>
        </main>

        <section>
                 <div class="text-1">
                    <div class="box">
                     </div>
                         <p>Today's</p>
                 </div>
                     <h3>What's New</h3>
                <div class="course-parent">
    @foreach($newCourses as $course)
    <div class="child">
        <div class="child-header">
            <i class="fa-solid fa-book"></i>
            <div class="heart">
                <i class="fa fa-heart"></i>
                <i class="fa fa-eye"></i>
            </div>
        </div>
        <div class="child-body">
            <p class="course-title">{{ $course->title }}</p>
            <p class="course-info"><i class="fa fa-clock"></i> {{ $course->schedule }}</p>
            <p class="course-info"><i class="fa fa-calendar"></i> {{ $course->duration }}</p>
            <p class="course-info"><i class="fa fa-location-dot"></i> {{ Str::limit($course->location, 30) }}</p>
            <div class="course-stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <a href="{{ route('course.detail', $course->id) }}" class="btn-view-course">View Course</a>
        </div>
    </div>
    @endforeach
</div>


            <div class="view-parent">
                <div class="view-child">
                    <button class="btn_view_courses">View All Courses</button>
                </div>
            </div>
        </section>




    </div>



    <div class="container-1">

        <section class="section-3">
            <div class="text-2">
                <div class="box">

                </div>
                <p>AVAILABLE COURSE</p>

            </div>

            <h3>OTHER COURSES</h3>

            <div class="course-parent">
                @forelse($otherCourses as $course)
                <div class="child">
                    <div class="child-header">
                        <i class="fa-solid fa-book"></i>
                        <div class="heart">
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                    <div class="child-body">
                        <p class="course-title">{{ $course->title }}</p>
                        <p class="course-info"><i class="fa fa-clock"></i> {{ $course->schedule }}</p>
                        <p class="course-info"><i class="fa fa-calendar"></i> {{ $course->duration }}</p>
                        <p class="course-info"><i class="fa fa-location-dot"></i> {{ Str::limit($course->location, 30) }}</p>
                        <div class="course-stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="{{ route('course.detail', $course->id) }}" class="btn-view-course">View Course</a>
                    </div>
                </div>
                @empty
                    <p style="color:#888;">No other courses available.</p>
                @endforelse
            </div>


    </div>

    <div class="container-2">

        <section class="section-4">
            <div class="text-1">
                <div class="box">

                </div>
                <p>Community</p>

            </div>

            <div class="commercial parent">
                <div class="photo-1">


           </div>
                <div class="commercial parent">
                    <div class="photo-2">

                        <div class="photo-child-1">

                        </div>

                        <div class="photo-child-2">


                   </div>
                 </div>
             </div>
        </div>
    </div>
@endsection