@extends('trainer.layout')

@section('title', 'courses')

@section('css')
<link rel="stylesheet" href="{{ asset('stylesheet/courses.css') }}">
@endsection

@section('content')
                    <div class="courses-panel">
                        <h2 class="panel-title">Courses</h2>
                        
                        <div class="courses-grid">
                            <div class="course-card">
                                <div class="card-img">
                                    <img src="{{ asset('images/1.jpg') }}" alt="Computer Literacy">
                                </div>
                                <div class="card-body">
                                    <h3>Computer Literacy</h3>
                                    <p>Instructor: Iya Hufancia</p>
                                    <p>Enrollment Status: 18/ 20</p>
                                    <a href="#" class="view-btn">View Course</a>
                                </div>
                            </div>

                            <div class="course-card">
                                <div class="card-img">
                                    <img src={{ asset('images/2.jpg') }} alt="Fashion Bayong">
                                </div>
                                <div class="card-body">
                                    <h3>Fashion Bayong</h3>
                                    <p>Instructor: Joel Bermudez</p>
                                    <p>Enrollment Status: 14/ 15</p>
                                    <a href="#" class="view-btn">View Course</a>
                                </div>
                            </div>

                            <div class="course-card">
                                <div class="card-img">
                                    <img src={{ asset('images/3.jpg') }} alt="Candle Making">
                                </div>
                                <div class="card-body">
                                    <h3>Candle Making</h3>
                                    <p>Instructor: Cesar Galingana</p>
                                    <p>Enrollment Status: 20/ 20</p>
                                    <a href="#" class="view-btn">View Course</a>
                                </div>
                            </div>

                            <div class="course-card">
                                <div class="card-img">
                                    <img src={{ asset('images/4.jpg') }} alt="Hilot Wellness">
                                </div>
                                <div class="card-body">
                                    <h3>Hilot Wellness</h3>
                                    <p>Instructor: Myrna Lana</p>
                                    <p>Enrollment Status: 15/ 15</p>
                                    <a href="#" class="view-btn">View Course</a>
                                </div>
                            </div>

                            <div class="course-card">
                                <div class="card-img">
                                    <img src={{ asset('images/5.jpg') }} alt="Basic Sewing">
                                </div>
                                <div class="card-body">
                                    <h3>Basic Sewing</h3>
                                    <p>Instructor: Rogelio Amoyan</p>
                                    <p>Enrollment Status: 19/ 20</p>
                                    <a href="#" class="view-btn">View Course</a>
                                </div>
                            </div>

                            <div class="create-card" id="openModal">
                                <div class="create-inner">
                                    <i class="fas fa-plus"></i>
                                    <p>Create New Course</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
@endsection
