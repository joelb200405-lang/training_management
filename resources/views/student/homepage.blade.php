@extends('student.layout')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" href="{{ asset('stylesheet/homepage.css') }}">
<style>
/* ==========================================================================
   9. FOOTER STYLES
   ========================================================================== */
.footer {
    background: #025628;
    color: #ffffff;
    padding: 25px 0 10px 0;
    font-size: 11px;
    width: 100%;
}

.footer-content {
    max-width: 1100px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    flex-wrap: wrap;
}

.footer-col {
    flex: 1;
    min-width: 250px;
    margin-bottom: 10px;
}

.footer-col h3 {
    font-size: 18px;
    margin-bottom: 10px;
    font-weight: 600;
}

.footer-col h3::after {
    content: '';
    display: block;
    width: 30px;
    height: 2px;
    background: var(--yellow-head);
    margin-top: 8px;
}

.footer-col p {
    line-height: 1.8;
    margin-bottom: 12px;
    opacity: 0.9;
}

.footer-col ul {
    list-style: none;
    padding: 0;
}

.footer-col ul li {
    margin-bottom: 12px;
}

.footer-col a {
    color: #ffffff;
    text-decoration: none;
    opacity: 0.8;
    transition: all 0.3s ease;
}

.footer-col a:hover {
    opacity: 1;
    padding-left: 5px;
    color: var(--yellow-head);
}

.footer-bottom {
    text-align: center;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    margin-top: 0;
    padding-top: 5px;
}

.footer-bottom p {
    opacity: 0.6;
    font-size: 12px;
}</style>
@endsection

@section('content')
<div class="Homepage_wrap">


    <div class="Top_row">

        <div class="Welcome_card">
            <h2>Hello, {{ Auth::user()->firstname }}! 👋</h2>
            <div class="welcome-date">{{ now()->format('l, F d, Y') }} · LEDIPO</div>
            <div class="welcome-stats">
                <div class="wstat">
                    <div class="wstat-num">{{ $enrollment ? ucfirst($enrollment->status) : 'None' }}</div>
                    <div class="wstat-lbl">Status</div>
                </div>
                <div class="wstat">
                    <div class="wstat-num">{{ $enrollment ? ($enrollment->progress ?? 0) . '%' : '0%' }}</div>
                    <div class="wstat-lbl">Progress</div>
                </div>
                <div class="wstat">
                    <div class="wstat-num">{{ $upcomingDeadlines }}</div>
                    <div class="wstat-lbl">Deadlines</div>
                </div>
            </div>
        </div>

        <div class="schedule-card">
            <div class="scard-title">📅 Today's Schedule</div>
            @if($enrollment && $enrollment->course)
                <div class="sched-row">
                    <div class="sched-time">{{ $enrollment->course->schedule }}</div>
                    <div class="sched-info">
                        <div class="sched-name">{{ $enrollment->course->title }}</div>
                        <div class="sched-loc">📍 {{ $enrollment->course->location }}</div>
                    </div>
                </div>
            @else
                <div class="no-sched">No active course today.</div>
            @endif
        </div>

    </div>

    <div class="sec">
        <div class="sec-title">📢 Announcements</div>
        <div class="announce-list">
            @forelse($announcements as $announcement)
                @php
                    $type = $announcement->type ?? 'reminder';
                    if ($type === 'urgent') {
                        $dotColor  = '#A32D2D';
                        $badgeClass = 'b-red';
                        $badgeLabel = 'Urgent';
                    } elseif ($type === 'notice') {
                        $dotColor  = '#854F0B';
                        $badgeClass = 'b-yellow';
                        $badgeLabel = 'Notice';
                    } else {
                        $dotColor  = '#3B6D11';
                        $badgeClass = 'b-green';
                        $badgeLabel = 'Reminder';
                    }
                @endphp
                <div class="an-item">
                    <div class="an-dot" style="background: {{ $dotColor }}"></div>
                    <div class="an-info">
                        <div class="an-title">{{ $announcement->title }}</div>
                        <div class="an-desc">{{ $announcement->message }}</div>
                    </div>
                    <span class="an-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                </div>
            @empty
                <div class="empty-state">
                    <p>No announcements at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>

    
<div class="sec">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;">
        <div class="sec-title" style="margin-bottom:0;">📖 My Current Course</div>

        {{-- Course switcher dropdown --}}
        @if($enrollments->count() > 1)
        <form method="GET" action="{{ route('homepage') }}" id="courseSwitchForm">
            <select name="course_id"
                onchange="document.getElementById('courseSwitchForm').submit()"
                style="padding:7px 12px; border:1px solid #e8ede9; border-radius:8px;
                       font-size:13px; font-family:inherit; color:#025628;
                       background:#fff; outline:none; cursor:pointer;">
                @foreach($enrollments as $e)
                    <option value="{{ $e->course_id }}"
                        {{ $enrollment && $enrollment->course_id == $e->course_id ? 'selected' : '' }}>
                        {{ $e->course->title ?? 'Course' }}
                    </option>
                @endforeach
            </select>
        </form>
        @endif
    </div>

    {{-- rest of the existing course card code... --}}
        @if($enrollment && $enrollment->course)
            <div class="course-card">
                <div class="course-top">
                    <div class="course-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div>
                        <div class="course-name">{{ $enrollment->course->title }}</div>
                        <span class="course-badge">{{ $enrollment->course->sector }}</span>
                    </div>
                </div>
                <div class="course-meta-row">
                    <div class="cmeta">
                        <div class="cmeta-label">Duration</div>
                        <div class="cmeta-val">{{ $enrollment->course->duration }}</div>
                    </div>
                    <div class="cmeta">
                        <div class="cmeta-label">Schedule</div>
                        <div class="cmeta-val">{{ $enrollment->course->schedule }}</div>
                    </div>
                    <div class="cmeta">
                        <div class="cmeta-label">Slots left</div>
                        <div class="cmeta-val">{{ $enrollment->course->slots }}</div>
                    </div>
                </div>
                <div class="progress-label">
                    <span>Overall Progress</span>
                    <span>{{ $enrollment->progress ?? 0 }}%</span>
                </div>
                <div class="pbar">
                    <div class="pfill" style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                </div>
                @if(isset($enrollment->course->trainer))
                    <div class="course-instructor">
                        👤 Trainer: <strong>{{ $enrollment->course->trainer->firstname }} {{ $enrollment->course->trainer->lastname }}</strong>
                    </div>
                @endif
                <a href="{{ route('course.detail', $enrollment->course->id) }}" class="course-view-btn">
                    View Course Details
                </a>
            </div>
        @else
            <div class="no-course">
                <p>You are not enrolled in any course yet.</p>
                <a href="{{ route('all.courses') }}" class="enroll-btn">Browse Courses</a>
            </div>
        @endif
    </div>

    {{-- MODULE MATERIALS --}}
    <div class="sec" id="modules">
        <div class="sec-title">📦 Module Materials</div>
        @if($enrollment && isset($modules) && $modules->count() > 0)
            <div class="mod-list">
                @foreach($modules as $module)
                    @php
                        $ext = strtolower(pathinfo($module->file_path, PATHINFO_EXTENSION));
                        if ($ext === 'pdf') {
                            $iconClass = 'mod-pdf';
                            $icon = '📄';
                        } elseif (in_array($ext, ['doc', 'docx'])) {
                            $iconClass = 'mod-doc';
                            $icon = '📝';
                        } else {
                            $iconClass = 'mod-vid';
                            $icon = '🎬';
                        }
                    @endphp
                    <div class="mod-item">
                        <div class="mod-icon {{ $iconClass }}">{{ $icon }}</div>
                        <div class="mod-info">
                            <div class="mod-title">{{ $module->title }}</div>
                            <div class="mod-sub">{{ strtoupper($ext) }} · {{ $enrollment->course->title }}</div>
                        </div>
                        <a href="{{ asset('storage/' . $module->file_path) }}" download class="mod-btn">
                            ⬇ Download
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>No modules available yet.</p>
            </div>
        @endif
        {{-- QUIZZES --}}
            <div class="sec" id="quizzes">
                <div class="sec-title">📝 My Quizzes</div>
                @if($enrollment && isset($quizzes) && $quizzes->count() > 0)
                    <div class="mod-list" id="quiz-list-wrapper">
                        @foreach($quizzes as $quiz)
                            @php
                                $result = $quizResults->where('quiz_id', $quiz->id)->first();
                            @endphp
                            <div class="mod-item" id="quiz-item-{{ $quiz->id }}">
                                <div class="mod-icon mod-doc">📝</div>
                                <div class="mod-info">
                                    <div class="mod-title">{{ $quiz->title }}</div>
                                    <div class="mod-sub">
                                        ⏱ {{ $quiz->time_limit }}m · 🎯 {{ $quiz->passing_score }}% to pass
                                        @if($result)
                                            · 
                                            <span style="color: {{ $result->status === 'passed' ? '#025628' : '#A32D2D' }}; font-weight:700;">
                                                {{ $result->status === 'passed' ? '✅ Passed' : '❌ Failed' }} 
                                                ({{ $result->percentage }}%)
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($result)
                                    <span style="padding:6px 14px; border-radius:8px; font-size:12px; font-weight:700;
                                        background: {{ $result->status === 'passed' ? '#e8f5e9' : '#FCEBEB' }};
                                        color: {{ $result->status === 'passed' ? '#025628' : '#A32D2D' }};">
                                        {{ $result->score }}/{{ $result->total_items }}
                                    </span>
                                @else
                                    <button onclick="openQuizModal({{ $quiz->id }}, '{{ addslashes($quiz->title) }}')"
                                        class="mod-btn" style="background:#025628; color:#fff; border:none; cursor:pointer;">
                                        Take Quiz
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <p>No quizzes available yet.</p>
                    </div>
                @endif
            </div>

            {{-- QUIZ MODAL --}}
            <div id="quizModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0;
                background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
                <div style="background:#fff; border-radius:16px; width:95%; max-width:600px;
                            max-height:90vh; overflow-y:auto; padding:24px; position:relative;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                        <h3 style="font-size:16px; font-weight:700; color:#025628;" id="quizModalTitle">Quiz</h3>
                        <button onclick="closeQuizModal()"
                            style="background:none; border:none; font-size:20px; cursor:pointer; color:#888;">✕</button>
                    </div>

                    {{-- Loading --}}
                    <div id="quizLoading" style="text-align:center; padding:40px; color:#aaa;">
                        <i class="fa fa-spinner fa-spin"></i> Loading questions...
                    </div>

                    {{-- Questions --}}
                    <div id="quizContent" style="display:none;">
                        <div id="quizQuestionsContainer" style="display:flex; flex-direction:column; gap:16px;"></div>
                        <button onclick="submitQuiz()"
                            style="width:100%; margin-top:20px; background:#025628; color:#fff; border:none;
                                border-radius:10px; padding:12px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
                            Submit Quiz
                        </button>
                    </div>

                    {{-- Result --}}
                    <div id="quizResult" style="display:none; text-align:center; padding:20px 0;">
                        <div id="quizResultIcon" style="font-size:48px; margin-bottom:12px;"></div>
                        <div id="quizResultTitle" style="font-size:20px; font-weight:700; margin-bottom:8px;"></div>
                        <div id="quizResultScore" style="font-size:15px; color:#555; margin-bottom:16px;"></div>
                        <button onclick="closeQuizModal()"
                            style="background:#025628; color:#fff; border:none; border-radius:10px;
                                padding:10px 32px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
                            Close
                        </button>
                    </div>
                </div>
            </div>

            <script>
            let _activeQuizId   = null;
            let _quizQuestions  = [];

            function openQuizModal(quizId, title) {
                _activeQuizId = quizId;
                document.getElementById('quizModalTitle').textContent = title;
                document.getElementById('quizModal').style.display    = 'flex';
                document.getElementById('quizLoading').style.display  = 'block';
                document.getElementById('quizContent').style.display  = 'none';
                document.getElementById('quizResult').style.display   = 'none';

                fetch(`/student/quiz/${quizId}`, {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                })
                .then(r => r.json())
                .then(data => {
                    _quizQuestions = data.quiz.questions || [];
                    document.getElementById('quizLoading').style.display = 'none';
                    document.getElementById('quizContent').style.display = 'block';
                    renderQuizQuestions();
                })
                .catch(() => alert('Hindi ma-load ang quiz. Subukan ulit.'));
            }

            function renderQuizQuestions() {
                const container = document.getElementById('quizQuestionsContainer');
                container.innerHTML = _quizQuestions.map((q, i) => `
                    <div style="background:#f9f9f9; border-radius:10px; padding:14px;">
                        <div style="font-size:14px; font-weight:600; color:#1a1a1a; margin-bottom:10px;">
                            ${i+1}. ${escQ(q.question)}
                        </div>
                        <div style="display:flex; flex-direction:column; gap:6px;">
                            ${['a','b','c','d'].map(opt => `
                                <label style="display:flex; align-items:center; gap:10px; padding:8px 12px;
                                            background:#fff; border:1px solid #eee; border-radius:8px; cursor:pointer;
                                            font-size:13px; color:#333;">
                                    <input type="radio" name="q_${q.id}" value="${opt}"
                                        style="accent-color:#025628; width:16px; height:16px;">
                                    <span><strong>${opt.toUpperCase()}.</strong> ${escQ(q['choice_'+opt])}</span>
                                </label>
                            `).join('')}
                        </div>
                    </div>
                `).join('');
            }

            function submitQuiz() {
                const answers = {};
                let allAnswered = true;

                _quizQuestions.forEach((q, i) => {
                    const selected = document.querySelector(`input[name="q_${q.id}"]:checked`);
                    if (!selected) { allAnswered = false; }
                    else { answers[q.id] = selected.value; }
                });

                if (!allAnswered) {
                    alert('Sagutin muna ang lahat ng questions bago mag-submit!');
                    return;
                }

                fetch('/student/quiz/submit', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ quiz_id: _activeQuizId, answers })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) showQuizResult(data);
                    else alert(data.message || 'May error.');
                })
                .catch(() => alert('May error. Subukan ulit.'));
            }

            function showQuizResult(data) {
                document.getElementById('quizContent').style.display = 'none';
                document.getElementById('quizResult').style.display  = 'block';

                const passed = data.status === 'passed';
                document.getElementById('quizResultIcon').textContent  = passed ? '🎉' : '😔';
                document.getElementById('quizResultTitle').textContent = passed ? 'Passed!' : 'Failed';
                document.getElementById('quizResultTitle').style.color = passed ? '#025628' : '#A32D2D';
                document.getElementById('quizResultScore').innerHTML   =
                    `Score: <strong>${data.score}/${data.total}</strong> (${data.percentage}%)<br>
                    Passing score: ${data.passing}%`;

                // Update UI ng quiz item
                const item = document.getElementById(`quiz-item-${_activeQuizId}`);
                if (item) {
                    const btn = item.querySelector('button');
                    if (btn) {
                        btn.outerHTML = `<span style="padding:6px 14px; border-radius:8px; font-size:12px; font-weight:700;
                            background: ${passed ? '#e8f5e9' : '#FCEBEB'};
                            color: ${passed ? '#025628' : '#A32D2D'};">
                            ${data.score}/${data.total}
                        </span>`;
                    }
                }
            }

            function closeQuizModal() {
                document.getElementById('quizModal').style.display = 'none';
                _activeQuizId  = null;
                _quizQuestions = [];
            }

            function escQ(str) {
                const d = document.createElement('div');
                d.appendChild(document.createTextNode(str || ''));
                return d.innerHTML;
            }
            </script>
    </div>

    {{-- TRAINING LOCATION --}}
    <div class="sec" id="location">
        <div class="sec-title">📍 Training Location</div>
        @if($enrollment && $enrollment->course)
            <div class="loc-card">
                <div class="loc-map">
                    🗺️ {{ $enrollment->course->location }}
                </div>
                <div class="loc-body">
                    <div class="loc-name">{{ $enrollment->course->title }}</div>
                    <div class="loc-addr">📍 {{ $enrollment->course->location }}</div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <p>No location available. Enroll in a course first.</p>
            </div>
        @endif
    </div>

</div>

   <footer class="footer">
        <div class="footer-content">
            <div class="footer-col">
                <h3>Support</h3>
                <p>Barangay Burol Main, City of Dasmariñas, Cavite, Philippines.</p>
                <p><a href="mailto:Regals@gmail.com">Regals@gmail.com</a></p>
                <p>+88015-88888-9999</p>
            </div>
            <div class="footer-col">
                <h3>Account</h3>
                <ul>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Login / Register</a></li>
                    <li><a href="#">Likes</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Quick Link</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms Of Use</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Copyright Rimel 2022. All right reserved</p>
        </div>
    </footer>
@endsection