@extends('student.layout')

@section('title', 'My Modules')

@section('css')
  <style>
    .mod-wrap {
      padding: 28px;
      max-width: 760px;
    }

    /* ── Page header ──────────────────────────────────────────── */
    .mod-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 12px;
    }

    .mod-page-title {
      font-size: 20px;
      font-weight: 700;
      color: #025628;
    }

    .mod-course-select {
      padding: 8px 12px;
      border: 1px solid #e8ede9;
      border-radius: 8px;
      font-size: 13px;
      font-family: "Open Sans", sans-serif;
      color: #1a1a1a;
      background: #fff;
      outline: none;
      cursor: pointer;
    }

    .mod-course-select:focus {
      border-color: #025628;
    }

    /* ── Stat bar ─────────────────────────────────────────────── */
    .mod-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
      margin-bottom: 20px;
    }

    .mod-stat {
      background: #fff;
      border: 1px solid #e8ede9;
      border-radius: 10px;
      padding: 14px;
      text-align: center;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .mod-stat-val {
      font-size: 22px;
      font-weight: 700;
      color: #025628;
      line-height: 1;
    }

    .mod-stat-lbl {
      font-size: 11px;
      color: #aaa;
      margin-top: 4px;
    }

    /* ── Cards ────────────────────────────────────────────────── */
    .mod-card {
      background: #fff;
      border: 1px solid #e8ede9;
      border-radius: 12px;
      padding: 18px 20px;
      margin-bottom: 16px;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .mod-card-title {
      font-size: 14px;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 14px;
      padding-bottom: 10px;
      border-bottom: 1px solid #f0f4f0;
    }

    /* ── Module items ─────────────────────────────────────────── */
    .mod-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 0;
      border-bottom: 1px solid #f0f4f0;
    }

    .mod-item:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .mod-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: #fce8e8;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }

    .mod-icon.doc {
      background: #e8eefe;
    }

    .mod-icon.vid {
      background: #e8f5e9;
    }

    .mod-info {
      flex: 1;
      min-width: 0;
    }

    .mod-name {
      font-size: 13px;
      font-weight: 600;
      color: #1a1a1a;
    }

    .mod-sub {
      font-size: 11px;
      color: #aaa;
      margin-top: 2px;
    }

    .mod-dl-btn {
      font-size: 12px;
      font-weight: 600;
      padding: 6px 14px;
      border-radius: 8px;
      border: 1px solid #025628;
      color: #025628;
      background: transparent;
      text-decoration: none;
      flex-shrink: 0;
      transition: all 0.18s;
      display: inline-block;
    }

    .mod-dl-btn:hover {
      background: #025628;
      color: #fff;
    }

    /* ── Overall progress ─────────────────────────────────────── */
    .mod-progress-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 16px;
    }

    .mod-progress-label {
      font-size: 12px;
      color: #aaa;
      flex-shrink: 0;
    }

    .mod-pbar-bg {
      flex: 1;
      height: 6px;
      background: #f0f4f0;
      border-radius: 3px;
      overflow: hidden;
    }

    .mod-pbar-fill {
      height: 100%;
      background: #025628;
      border-radius: 3px;
    }

    .mod-pbar-pct {
      font-size: 12px;
      font-weight: 700;
      color: #025628;
      flex-shrink: 0;
      min-width: 30px;
      text-align: right;
    }

    /* ── Quiz items ───────────────────────────────────────────── */
    .quiz-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 0;
      border-bottom: 1px solid #f0f4f0;
    }

    .quiz-item:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .quiz-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: #e8f5e9;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }

    .quiz-info {
      flex: 1;
      min-width: 0;
    }

    .quiz-name {
      font-size: 13px;
      font-weight: 600;
      color: #1a1a1a;
    }

    .quiz-meta {
      font-size: 11px;
      color: #aaa;
      margin-top: 2px;
    }

    .quiz-btn-take {
      font-size: 12px;
      font-weight: 600;
      padding: 6px 14px;
      border-radius: 8px;
      border: none;
      background: #025628;
      color: #fff;
      cursor: pointer;
      font-family: "Open Sans", sans-serif;
      flex-shrink: 0;
      transition: background 0.18s;
    }

    .quiz-btn-take:hover {
      background: #013d1c;
    }

    .quiz-score-passed {
      font-size: 12px;
      font-weight: 600;
      padding: 6px 14px;
      border-radius: 8px;
      background: #e8f5e9;
      color: #025628;
      flex-shrink: 0;
    }

    .quiz-score-failed {
      font-size: 12px;
      font-weight: 600;
      padding: 6px 14px;
      border-radius: 8px;
      background: #FCEBEB;
      color: #791F1F;
      flex-shrink: 0;
    }

    /* ── Empty state ──────────────────────────────────────────── */
    .mod-empty {
      text-align: center;
      padding: 32px;
      color: #aaa;
      font-size: 13px;
    }

    .mod-empty i {
      font-size: 28px;
      opacity: 0.3;
      display: block;
      margin-bottom: 8px;
    }

    /* ── Responsive ───────────────────────────────────────────── */
    @media (max-width: 540px) {
      .mod-wrap {
        padding: 16px;
      }

      .mod-stats {
        grid-template-columns: 1fr 1fr;
      }
    }
  </style>
@endsection

@section('content')
  <div class="mod-wrap">

    {{-- ── HEADER ──────────────────────────────────────────── --}}
    <div class="mod-header">
      <div class="mod-page-title">My Modules</div>

      @if ($enrollments->count() > 1)
        <form method="GET" action="{{ route('student.modules') }}"
          id="courseSwitchForm">
          <select name="course_id" class="mod-course-select"
            onchange="document.getElementById('courseSwitchForm').submit()">
            @foreach ($enrollments as $e)
              <option value="{{ $e->course_id }}"
                {{ $enrollment && $enrollment->course_id == $e->course_id ? 'selected' : '' }}>
                {{ $e->course->title ?? 'Course' }}
              </option>
            @endforeach
          </select>
        </form>
      @else
        <span style="font-size:13px;color:#aaa;">
          {{ $enrollment->course->title ?? '' }}
        </span>
      @endif
    </div>

    {{-- ── STAT BAR ─────────────────────────────────────────── --}}
    <div class="mod-stats">
      <div class="mod-stat">
        <div class="mod-stat-val">{{ $modules->count() }}</div>
        <div class="mod-stat-lbl">Modules</div>
      </div>
      <div class="mod-stat">
        <div class="mod-stat-val">{{ $quizzes->count() }}</div>
        <div class="mod-stat-lbl">Quizzes</div>
      </div>
      <div class="mod-stat">
        <div class="mod-stat-val">{{ $enrollment->progress ?? 0 }}%</div>
        <div class="mod-stat-lbl">Progress</div>
      </div>
    </div>

    {{-- ── MODULE MATERIALS ─────────────────────────────────── --}}
    <div class="mod-card">
      <div class="mod-card-title">Module materials</div>

      @forelse($modules as $module)
        @php
          $ext = strtolower(
              pathinfo($module->file_path ?? '', PATHINFO_EXTENSION),
          );
          if ($ext === 'pdf') {
              $iconClass = '';
              $icon = '📄';
          } elseif (in_array($ext, ['doc', 'docx'])) {
              $iconClass = 'doc';
              $icon = '📝';
          } else {
              $iconClass = 'vid';
              $icon = '🎬';
          }
        @endphp
        <div class="mod-item">
          <div class="mod-icon {{ $iconClass }}">{{ $icon }}</div>
          <div class="mod-info">
            <div class="mod-name">{{ $module->title }}</div>
            <div class="mod-sub">
              {{ strtoupper($ext) ?: 'FILE' }} ·
              {{ $enrollment->course->title ?? '' }}
            </div>
          </div>
          @if ($module->file_path)
            <a href="{{ asset('storage/' . $module->file_path) }}" download
              class="mod-dl-btn">
              <i class="fa fa-download"></i> Download
            </a>
          @endif
        </div>
      @empty
        <div class="mod-empty">
          <i class="fa fa-box-open"></i>
          No modules available yet.
        </div>
      @endforelse
    </div>

    {{-- ── QUIZZES ──────────────────────────────────────────── --}}
    <div class="mod-card">
      <div class="mod-card-title">My quizzes</div>

      {{-- Overall progress --}}
      <div class="mod-progress-row">
        <span class="mod-progress-label">Overall</span>
        <div class="mod-pbar-bg">
          <div class="mod-pbar-fill"
            style="width: {{ $enrollment->progress ?? 0 }}%"></div>
        </div>
        <span class="mod-pbar-pct">{{ $enrollment->progress ?? 0 }}%</span>
      </div>

      @forelse($quizzes as $quiz)
        @php
          $result = $quizResults->where('quiz_id', $quiz->id)->first();
        @endphp
        <div class="quiz-item" id="quiz-item-{{ $quiz->id }}">
          <div class="quiz-icon">📝</div>
          <div class="quiz-info">
            <div class="quiz-name">{{ $quiz->title }}</div>
            <div class="quiz-meta">
              ⏱ {{ $quiz->time_limit }}m · 🎯 {{ $quiz->passing_score }}% to
              pass
              @if ($result)
                ·
                <span
                  style="color: {{ $result->status === 'passed' ? '#025628' : '#A32D2D' }}; font-weight:700;">
                  {{ $result->status === 'passed' ? '✅ Passed' : '❌ Failed' }}
                  ({{ $result->percentage }}%)
                </span>
              @endif
            </div>
          </div>
          @if ($result)
            <span
              class="{{ $result->status === 'passed' ? 'quiz-score-passed' : 'quiz-score-failed' }}">
              {{ $result->score }}/{{ $result->total_items }}
            </span>
          @else
            <button
              onclick="openQuizModal({{ $quiz->id }}, '{{ addslashes($quiz->title) }}')"
              class="quiz-btn-take">
              Take Quiz
            </button>
          @endif
        </div>
      @empty
        <div class="mod-empty">
          <i class="fa fa-clipboard"></i>
          No quizzes available yet.
        </div>
      @endforelse
    </div>

  </div>

  {{-- ── QUIZ MODAL (same as homepage) ──────────────────────── --}}
  <div id="quizModal"
    style="display:none; position:fixed; top:0; left:0; right:0; bottom:0;
    background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
    <div
      style="background:#fff; border-radius:16px; width:95%; max-width:600px;
                max-height:90vh; overflow-y:auto; padding:24px; position:relative;">
      <div
        style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h3 style="font-size:16px; font-weight:700; color:#025628;"
          id="quizModalTitle">Quiz</h3>
        <button onclick="closeQuizModal()"
          style="background:none; border:none; font-size:20px; cursor:pointer; color:#888;">✕</button>
      </div>

      <div id="quizLoading" style="text-align:center; padding:40px; color:#aaa;">
        <i class="fa fa-spinner fa-spin"></i> Loading questions...
      </div>

      <div id="quizContent" style="display:none;">
        <div id="quizQuestionsContainer"
          style="display:flex; flex-direction:column; gap:16px;"></div>
        <button onclick="submitQuiz()"
          style="width:100%; margin-top:20px; background:#025628; color:#fff; border:none;
                    border-radius:10px; padding:12px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
          Submit Quiz
        </button>
      </div>

      <div id="quizResult"
        style="display:none; text-align:center; padding:20px 0;">
        <div id="quizResultIcon" style="font-size:48px; margin-bottom:12px;">
        </div>
        <div id="quizResultTitle"
          style="font-size:20px; font-weight:700; margin-bottom:8px;"></div>
        <div id="quizResultScore"
          style="font-size:15px; color:#555; margin-bottom:16px;"></div>
        <button onclick="closeAndReload()"
          style="background:#025628; color:#fff; border:none; border-radius:10px;
                    padding:10px 32px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
          Close
        </button>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script>
    let _activeQuizId = null;
    let _quizQuestions = [];

    function openQuizModal(quizId, title) {
      _activeQuizId = quizId;
      document.getElementById('quizModalTitle').textContent = title;
      document.getElementById('quizModal').style.display = 'flex';
      document.getElementById('quizLoading').style.display = 'block';
      document.getElementById('quizContent').style.display = 'none';
      document.getElementById('quizResult').style.display = 'none';

      fetch(`/student/quiz/${quizId}`, {
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          }
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

      _quizQuestions.forEach(q => {
        const selected = document.querySelector(
          `input[name="q_${q.id}"]:checked`);
        if (!selected) {
          allAnswered = false;
        } else {
          answers[q.id] = selected.value;
        }
      });

      if (!allAnswered) {
        alert('Sagutin muna ang lahat ng questions bago mag-submit!');
        return;
      }

      fetch('/student/quiz/submit', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            quiz_id: _activeQuizId,
            answers
          })
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
      document.getElementById('quizResult').style.display = 'block';

      const passed = data.status === 'passed';
      document.getElementById('quizResultIcon').textContent = passed ? '🎉' :
      '😔';
      document.getElementById('quizResultTitle').textContent = passed ?
        'Passed!' : 'Failed';
      document.getElementById('quizResultTitle').style.color = passed ?
        '#025628' : '#A32D2D';
      document.getElementById('quizResultScore').innerHTML =
        `Score: <strong>${data.score}/${data.total}</strong> (${data.percentage}%)<br>
        Passing score: ${data.passing}%`;
    }

    function closeAndReload() {
      document.getElementById('quizModal').style.display = 'none';
      window.location.reload();
    }

    function closeQuizModal() {
      document.getElementById('quizModal').style.display = 'none';
      _activeQuizId = null;
      _quizQuestions = [];
    }

    function escQ(str) {
      const d = document.createElement('div');
      d.appendChild(document.createTextNode(str || ''));
      return d.innerHTML;
    }
  </script>
@endsection
