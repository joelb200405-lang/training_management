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
                    <a href="{{ route('all.courses') }}" class="btn_view_courses">View All Courses</a>
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
            <div class="box"></div>
            <p>Community</p>
        </div>
        <h3 style="padding-left: 50px; margin-bottom: 20px;">Our Community</h3>

        {{-- CAROUSEL --}}
        <div id="communityCarousel" class="carousel slide" data-bs-ride="carousel" style="padding: 0 50px;">
            
            {{-- INDICATORS --}}
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="4"></button>
            </div>

            {{-- SLIDES --}}
            <div class="carousel-inner" style="border-radius: 12px; overflow: hidden;">
                <div class="carousel-item active">
                    <img src="{{ asset('images/1.jpg') }}" class="d-block w-100" alt="Community Photo 1" style="height: 450px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                        <h5>Community Event 1</h5>
                        <p>Dasmariñas City Training Center</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/2.jpg') }}" class="d-block w-100" alt="Community Photo 2" style="height: 450px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                        <h5>Community Event 2</h5>
                        <p>Dasmariñas City Training Center</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/3.jpg') }}" class="d-block w-100" alt="Community Photo 3" style="height: 450px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                        <h5>Community Event 3</h5>
                        <p>Dasmariñas City Training Center</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/4.jpg') }}" class="d-block w-100" alt="Community Photo 4" style="height: 450px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                        <h5>Community Event 4</h5>
                        <p>Dasmariñas City Training Center</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/5.jpg') }}" class="d-block w-100" alt="Community Photo 5" style="height: 450px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); border-radius: 8px; padding: 10px 20px;">
                        <h5>Community Event 5</h5>
                        <p>Dasmariñas City Training Center</p>
                    </div>
                </div>
            </div>

            {{-- CONTROLS --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#communityCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#communityCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>
</div>
@endsection