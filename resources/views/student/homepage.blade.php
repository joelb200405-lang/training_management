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
    @foreach($courses as $course)
    <div class="child">
        <div class="child-header">
            <i class="fa-solid fa-book"></i>
            <div class="heart">
                <i class="fa fa-heart"></i>
                <i class="fa fa-eye"></i>
            </div>
        </div>
        <p>{{ $course->title }}</p>
        <h6><i class="fa fa-clock"></i> {{ $course->schedule }}</h6>
        <h6><i class="fa fa-calendar"></i> {{ $course->duration }}</h6>
        <h6><i class="fa fa-location-dot"></i> {{ $course->location }}</h6>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
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
                <div class="child child-1">

                    <div class="child-header">

                    </div>
                </div>
                <div class="child child-2">

                    <div class="child-header">

                    </div>

                </div>

                <div class="child child-3">

                    <div class="child-header">


                    </div>

                </div>

                <div class="child child-4">

                    <div class="child-header">


                    </div>

                </div>
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