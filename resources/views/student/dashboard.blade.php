@extends ('student.layout')

@section('title', 'My Dashboard')

@section('content')

<div class="Dashboard-wrap">

    <div class="header">
        <h1>My Dashboard</h1>
        <p>Hi {{ Auth::user()->firstname }} Here's your learning progress</p>
    </div>
     </div>

<!-- cards -->
     <div class="stats-row">
        <div class="cards">
            <div class="icon">
                <i class="fa fa-book-open"></i>
            </div>
            <div class="info">
                <div class="stat-label">Enrolled</div>
                <div class="stat-val">{{ $totalEnrolled }}</div>
            </div>
        </div>

        <div class="cards">
            <div class="icon">
                <i class="fa fa-circle-check"></i>
            </div>
            <div class="info">
                <div class="stat-label">Completed</div>
                <div class="stat-val">{{ $totalCompleted }}</div>
            </div>
        </div>

                <div class="cards">
            <div class="icon">
                <i class="fa fa-chart-line"></i>
            </div>
            <div class="info">
                <div class="stat-label">Avg progress</div>
                <div class="stat-val">{{ $avgProgress}}%</div>
            </div>
        </div>

         <div class="cards stat-card-danger">
            <div class="stat-icon stat-icon-danger">
                <i class="fa fa-triangle-exclamation"></i>
            </div>
            <div class="info">
                <div class="stat-label">Deadlines</div>
                <div class="stat-val stat-val-danger">{{ $upcomingDeadlines }}</div>
            </div>
         </div>
     </div>

     <!-- courses -->
        <div class="Section_title">My Courses</div>

        <div class="mc_list">
            @forelse($enrollments as $enrollment)
                <div class="mc_row">

                    <div class="mc_thumb">
                        <i class="fa fa-book"></i>
                    </div>

                    <div class="mc_info">
                        <div class="mc-title">{{ $enrollment->course->title }}</div>
                        <div class="mc-sub">{{ $enrollment->course->sector }} &middot; {{ $enrollment->course->duration }}</div>
                        <div class="mc-pbar">
                            <div class="mc-pfill" style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                        </div>
                    </div>

                    <div class="mc_right">
                        @if($enrollment->status === 'completed')
                            <div class="mc-pct mc-done">Done</div>
                            <a href="{{ route('course.detail', $enrollment->course->id) }}" class="mc-btn mc-btn-done">
                                Review
                            </a>
                        @else
                            <div class="mc-pct">{{ $enrollment->progress ?? 0 }}%</div>
                            <a href="{{ route('course.detail', $enrollment->course->id) }}" class="mc-btn">
                                Continue
                            </a>
                        @endif
                    </div>

                </div>
            @empty
                <div class="empty_state">
                    <i class="fa fa-book-open"></i>
                    <p>You are not enrolled in any courses yet.</p>
                    <a href="{{ route('all.courses') }}" class="btn-enroll-now">Browse Courses</a>
                </div>
            @endforelse
        </div>

    <!-- upcoming deadlines -->

     <div class="Section_title">Upcoming Deadlines</div>
 
    <div class="dl-list">
        @forelse($deadlines as $deadline)
            @php
                $daysLeft = now()->diffInDays($deadline->due_date, false);
                if ($daysLeft <= 2) {
                    $badgeClass = 'b-urgent';
                    $badgeLabel = 'Urgent';
                    $dotColor = '#A32D2D';
                } elseif ($daysLeft <= 5) {
                    $badgeClass = 'b-soon';
                    $badgeLabel = 'Soon';
                    $dotColor = '#854F0B';
                } else {
                    $badgeClass = 'b-ok';
                    $badgeLabel = 'On track';
                    $dotColor = '#3B6D11';
                }
            @endphp
            <div class="dl-row">
                <div class="dl-dot" style="background: {{ $dotColor }}"></div>
                <div class="dl-info">
                    <div class="dl-title">{{ $deadline->title }}</div>
                    <div class="dl-date">Due {{ \Carbon\Carbon::parse($deadline->due_date)->format('F d, Y') }}</div>
                </div>
                <span class="dl-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
            </div>
        @empty
            <div class="empty_state">
                <i class="fa fa-calendar-check"></i>
                <p>No upcoming deadlines. You're all caught up!</p>
            </div>
        @endforelse
    </div>
 
</div>

@endsection