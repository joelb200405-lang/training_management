@extends('trainer.layout')

@section('title', 'Assessment')

@section('css')
  <style>
    /* ── Page wrap ────────────────────────────────────────────── */
    .as-wrap {
      padding: 28px;
      max-width: 1100px;
    }

    .as-page-title {
      font-size: 20px;
      font-weight: 700;
      color: #025628;
      margin-bottom: 6px;
    }

    .as-page-sub {
      font-size: 13px;
      color: #aaa;
      margin-bottom: 24px;
    }

    /* ── Stat cards ───────────────────────────────────────────── */
    .as-stats {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      margin-bottom: 24px;
    }

    .as-stat {
      background: #fff;
      border: 1px solid #e0ede5;
      border-radius: 12px;
      padding: 18px 20px;
      position: relative;
      overflow: hidden;
    }

    .as-stat::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      background: #025628;
      border-radius: 12px 0 0 12px;
    }

    .as-stat.urgent::before {
      background: #A32D2D;
    }

    .as-stat-val {
      font-size: 26px;
      font-weight: 700;
      color: #025628;
      margin-bottom: 4px;
    }

    .as-stat.urgent .as-stat-val {
      color: #A32D2D;
    }

    .as-stat-label {
      font-size: 12px;
      color: #888;
      font-weight: 500;
    }

    .as-stat-link {
      font-size: 11px;
      color: #025628;
      cursor: pointer;
      text-decoration: underline;
      display: block;
      margin-top: 4px;
    }

    /* ── Filter row ───────────────────────────────────────────── */
    .as-filters {
      display: flex;
      gap: 10px;
      margin-bottom: 16px;
      flex-wrap: wrap;
    }

    .as-filter {
      padding: 7px 14px;
      border: 1.5px solid #e0ede5;
      border-radius: 20px;
      font-size: 13px;
      font-family: inherit;
      background: #fff;
      color: #444;
      cursor: pointer;
      outline: none;
      transition: border-color 0.2s;
    }

    .as-filter:focus {
      border-color: #025628;
    }

    /* ── Table card ───────────────────────────────────────────── */
    .as-table-card {
      background: #fff;
      border: 1px solid #e0ede5;
      border-radius: 12px;
      overflow: hidden;
      margin-bottom: 20px;
    }

    .as-table {
      width: 100%;
      border-collapse: collapse;
    }

    .as-table thead tr {
      background: #f0f7f2;
      border-bottom: 2px solid #e0ede5;
    }

    .as-table thead th {
      padding: 12px 16px;
      font-size: 12px;
      font-weight: 700;
      color: #025628;
      text-align: left;
      text-transform: uppercase;
      letter-spacing: .04em;
    }

    .as-table tbody tr {
      border-bottom: 1px solid #f0f4f0;
      transition: background 0.15s;
    }

    .as-table tbody tr:last-child {
      border-bottom: none;
    }

    .as-table tbody tr:hover {
      background: #f9fdf9;
    }

    .as-table td {
      padding: 12px 16px;
      font-size: 13px;
      color: #333;
    }

    .as-badge {
      display: inline-block;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
    }

    .as-badge.complete {
      background: #e8f5e9;
      color: #025628;
    }

    .as-badge.incomplete {
      background: #FCEBEB;
      color: #A32D2D;
    }

    .as-badge.competent {
      background: #e8f5e9;
      color: #025628;
    }

    .as-badge.not-competent {
      background: #fff8e1;
      color: #854F0B;
    }

    /* ── Action icons ─────────────────────────────────────────── */
    .as-actions {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .as-icon {
      width: 30px;
      height: 30px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 13px;
      border: none;
      transition: background 0.15s;
    }

    .as-icon.view {
      background: #e8f5e9;
      color: #025628;
    }

    .as-icon.edit {
      background: #e8f0fe;
      color: #3B5BDB;
    }

    .as-icon.delete {
      background: #FCEBEB;
      color: #A32D2D;
    }

    .as-icon:hover {
      opacity: 0.8;
    }

    /* ── Bottom row ───────────────────────────────────────────── */
    .as-bottom {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 4px;
    }

    .as-btn {
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      border: none;
      font-family: inherit;
      transition: background 0.2s;
    }

    .as-btn.primary {
      background: #025628;
      color: #fff;
    }

    .as-btn.primary:hover {
      background: #013d1c;
    }

    .as-btn.outline {
      background: #fff;
      color: #025628;
      border: 1.5px solid #025628;
    }

    .as-btn.outline:hover {
      background: #f0f7f2;
    }

    /* ── Empty state ──────────────────────────────────────────── */
    .as-empty {
      text-align: center;
      padding: 40px;
      color: #aaa;
      font-size: 13px;
    }

    .as-empty i {
      font-size: 36px;
      display: block;
      margin-bottom: 10px;
      opacity: 0.3;
      color: #025628;
    }

    /* ── MODALS ───────────────────────────────────────────────── */
    .as-modal {
      display: none;
      position: fixed;
      z-index: 3000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.45);
      backdrop-filter: blur(4px);
      align-items: center;
      justify-content: center;
    }

    .as-modal.open {
      display: flex;
    }

    .as-modal-content {
      background: #fff;
      border-radius: 16px;
      width: 90%;
      max-width: 500px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      animation: asModalIn 0.25s ease;
    }

    @keyframes asModalIn {
      from {
        transform: translateY(-20px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .as-modal-header {
      padding: 18px 24px;
      border-bottom: 1px solid #eee;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #f9fdf9;
    }

    .as-modal-header h3 {
      font-size: 15px;
      font-weight: 700;
      color: #025628;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .as-modal-close {
      font-size: 20px;
      color: #aaa;
      cursor: pointer;
      line-height: 1;
      background: none;
      border: none;
    }

    .as-modal-close:hover {
      color: #A32D2D;
    }

    .as-modal-body {
      padding: 20px 24px;
    }

    .as-modal-footer {
      padding: 14px 24px;
      border-top: 1px solid #eee;
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      background: #f9fdf9;
    }

    /* Modal form */
    .as-form-group {
      margin-bottom: 14px;
    }

    .as-form-group label {
      display: block;
      font-size: 11px;
      font-weight: 700;
      color: #555;
      margin-bottom: 5px;
      text-transform: uppercase;
      letter-spacing: .04em;
    }

    .as-form-group select,
    .as-form-group input {
      width: 100%;
      padding: 10px 12px;
      border: 1.5px solid #e0e0e0;
      border-radius: 8px;
      font-size: 13px;
      font-family: inherit;
      outline: none;
      transition: border-color 0.2s;
      color: #1a1a1a;
    }

    .as-form-group select:focus,
    .as-form-group input:focus {
      border-color: #025628;
    }

    .as-result-box {
      background: #f0f7f2;
      border: 1px solid #e0ede5;
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 14px;
      color: #025628;
      font-weight: 600;
      margin-top: 10px;
    }

    /* Detail rows */
    .as-detail-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #f0f4f0;
      font-size: 13px;
    }

    .as-detail-row:last-child {
      border-bottom: none;
    }

    .as-detail-label {
      color: #888;
    }

    .as-detail-val {
      font-weight: 600;
      color: #1a1a1a;
    }

    /* Top performers table */
    .as-top-table {
      width: 100%;
      border-collapse: collapse;
    }

    .as-top-table th {
      padding: 10px 12px;
      font-size: 11px;
      font-weight: 700;
      color: #025628;
      text-align: left;
      border-bottom: 2px solid #e0ede5;
      text-transform: uppercase;
      letter-spacing: .04em;
    }

    .as-top-table td {
      padding: 10px 12px;
      font-size: 13px;
      border-bottom: 1px solid #f0f4f0;
    }

    .as-top-table tr:last-child td {
      border-bottom: none;
    }

    @media (max-width: 768px) {
      .as-stats {
        grid-template-columns: repeat(2, 1fr);
      }

      .as-filters {
        flex-direction: column;
      }
    }
  </style>
@endsection

@section('content')
  <div class="as-wrap">

    <div class="as-page-title">Assessment</div>
    <div class="as-page-sub">Quiz results and competency records ng iyong mga
      trainees.</div>

    {{-- Stat Cards --}}
    <div class="as-stats">
      <div class="as-stat">
        <div class="as-stat-val">{{ $totalTaken }}</div>
        <div class="as-stat-label">Total Quiz Submissions</div>
      </div>
      <div class="as-stat">
        <div class="as-stat-val">{{ $avgScore }}%</div>
        <div class="as-stat-label">Average Class Score</div>
      </div>
      <div class="as-stat">
        <div class="as-stat-val">{{ $passingRate }}%</div>
        <div class="as-stat-label">Passing Rate</div>
      </div>
      <div class="as-stat urgent">
        <div class="as-stat-val">{{ $topPerformers->count() }}</div>
        <div class="as-stat-label">Top Performers</div>
        <span class="as-stat-link" onclick="openModal('topModal')">View all
          →</span>
      </div>
    </div>

    {{-- Filters --}}
    <div class="as-filters">
      <select class="as-filter" id="filterCourse" onchange="applyFilters()">
        <option value="">All Courses</option>
        @if ($course)
          <option value="{{ $course->title }}">{{ $course->title }}</option>
        @endif
      </select>
      <select class="as-filter" id="filterResult" onchange="applyFilters()">
        <option value="">All Activities</option>
        <option value="Complete">Complete</option>
        <option value="Incomplete">Incomplete</option>
      </select>
      <select class="as-filter" id="filterCompetency" onchange="applyFilters()">
        <option value="">All Competency</option>
        <option value="Competent">Competent</option>
        <option value="Not Yet Competent">Not Yet Competent</option>
      </select>
    </div>

    {{-- Table --}}
    <div class="as-table-card">
      <table class="as-table" id="assessmentTable">
        <thead>
          <tr>
            <th>Trainee ID</th>
            <th>Full Name</th>
            <th>Course</th>
            <th>Activities</th>
            <th>Competency</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($results as $result)
            <tr>
              <td>{{ $result->user->id }}</td>
              <td><strong>{{ $result->user->lastname }},
                  {{ $result->user->firstname }}</strong></td>
              <td>{{ $result->quiz->title }}</td>
              <td>
                <span
                  class="as-badge {{ $result->status === 'passed' ? 'complete' : 'incomplete' }}">
                  {{ $result->score }}/{{ $result->total_items }}
                  ({{ $result->percentage }}%)
                </span>
              </td>
              <td>
                <span
                  class="as-badge {{ $result->status === 'passed' ? 'competent' : 'not-competent' }}">
                  {{ $result->status === 'passed' ? 'Passed' : 'Failed' }}
                </span>
              </td>
              <td>
                <div class="as-actions">
                  <button class="as-icon view"
                    onclick="openDetailsModal('{{ $result->user->lastname }}, {{ $result->user->firstname }}', '{{ $result->user->id }}', '{{ $result->quiz->title }}', {{ $result->score }}, {{ $result->total_items }}, {{ $result->percentage }})"
                    title="View">
                    <i class="fa fa-eye"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6">
                <div class="as-empty">
                  <i class="fa fa-inbox"></i>
                  Walang quiz results pa.
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Bottom Actions --}}
    <div class="as-bottom">
      <button class="as-btn outline" onclick="exportToExcel()">
        <i class="fa fa-file-excel"></i> Export to Excel
      </button>
      <!-- <button class="as-btn primary" onclick="openModal('gradeModal')">
              <i class="fa fa-plus"></i> Add New Grade
          </button> -->
    </div>

  </div>

  {{-- Performance Details Modal --}}
  <div id="detailsModal" class="as-modal">
    <div class="as-modal-content">
      <div class="as-modal-header">
        <h3><i class="fa fa-chart-line"></i> Performance Details</h3>
        <button class="as-modal-close"
          onclick="closeModal('detailsModal')">&times;</button>
      </div>
      <div class="as-modal-body">
        <div
          style="display:flex; align-items:center; gap:14px; margin-bottom:16px; padding-bottom:16px; border-bottom:1px solid #f0f4f0;">
          <div
            style="width:46px; height:46px; border-radius:50%; background:#e8f5e9; display:flex; align-items:center; justify-content:center; font-size:18px; color:#025628; flex-shrink:0;">
            <i class="fa fa-user"></i>
          </div>
          <div>
            <div style="font-size:15px; font-weight:700; color:#1a1a1a;"
              id="det-name">—</div>
            <div style="font-size:12px; color:#888;" id="det-id">ID: —</div>
            <<div
              style="font-size:13px; color:#025628; font-weight:700; margin-top:4px;"
              id="det-score">—
          </div>
        </div>
      </div>
      <div
        style="font-size:11px; font-weight:700; color:#025628; text-transform:uppercase; letter-spacing:.04em; margin-bottom:8px;">
        Assessment Scores
      </div>
      <div class="as-detail-row">
        <span class="as-detail-label">Quiz 1</span>
        <span class="as-badge competent">85/100</span>
      </div>
      <div class="as-detail-row">
        <span class="as-detail-label">Quiz 2</span>
        <span class="as-badge competent">92/100</span>
      </div>
      <div
        style="font-size:11px; font-weight:700; color:#025628; text-transform:uppercase; letter-spacing:.04em; margin:14px 0 8px;">
        Activity Status
      </div>
      <div class="as-detail-row">
        <span class="as-detail-label"><i class="fa fa-check-circle"
            style="color:#025628;"></i> Lesson 1 Modules</span>
        <span class="as-badge complete">Done</span>
      </div>
      <div class="as-detail-row">
        <span class="as-detail-label"><i class="fa fa-times-circle"
            style="color:#A32D2D;"></i> Final Project Draft</span>
        <span class="as-badge incomplete">Missing</span>
      </div>
    </div>
    <div class="as-modal-footer">
      <button class="as-btn outline"
        onclick="closeModal('detailsModal')">Close</button>
    </div>
  </div>
  </div>

  {{-- Add Grade Modal --}}
  <div id="gradeModal" class="as-modal">
    <div class="as-modal-content">
      <div class="as-modal-header">
        <h3><i class="fa fa-plus-circle"></i> Add New Grade</h3>
        <button class="as-modal-close"
          onclick="closeModal('gradeModal')">&times;</button>
      </div>
      <div class="as-modal-body">
        <div class="as-form-group">
          <label>Select Trainee</label>
          <select id="gradeTrainee">
            <option value="" disabled selected>— Choose trainee —</option>
            <option value="2023-2-0018">Bong, Marcos</option>
            <option value="2023-2-0019">Ramos, Roshian</option>
          </select>
        </div>
        <div class="as-form-group">
          <label>Assessment</label>
          <select id="gradeAssessment">
            <option value="" disabled selected>— Choose assessment —
            </option>
            <option>Quiz 1</option>
            <option>Quiz 2</option>
            <option>Final Project</option>
          </select>
        </div>
        <div class="as-form-group">
          <label>Score (0–100)</label>
          <input type="number" id="gradeScore" placeholder="Enter score"
            min="0" max="100" oninput="calcResult()">
        </div>
        <div class="as-result-box" id="resultBox">
          Result: <span id="resultText">—</span>
        </div>
      </div>
      <div class="as-modal-footer">
        <button class="as-btn outline"
          onclick="closeModal('gradeModal')">Cancel</button>
        <button class="as-btn primary" onclick="saveGrade()">Save Grade</button>
      </div>
    </div>
  </div>

  {{-- Top Performers Modal --}}
  <div id="topModal" class="as-modal">
    <div class="as-modal-content">
      <div class="as-modal-header">
        <h3><i class="fa fa-trophy"></i> Top Performers</h3>
        <button class="as-modal-close"
          onclick="closeModal('topModal')">&times;</button>
      </div>
      <div class="as-modal-body" style="padding:0;">
        <table class="as-top-table">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Full Name</th>
              <th>Course</th>
              <th>Grade</th>
            </tr>
          </thead>
          <tbody>
            @forelse($topPerformers as $i => $tp)
              <tr>
                <td>
                  @if ($i === 0)
                    🥇
                  @elseif($i === 1)
                    🥈
                  @elseif($i === 2)
                    🥉
                  @else
                    {{ $i + 1 }}
                  @endif
                </td>
                <td><strong>{{ $tp->user->lastname }},
                    {{ $tp->user->firstname }}</strong></td>
                <td>{{ $course->title }}</td>
                <td><span
                    class="as-badge competent">{{ $tp->avg_score }}%</span></td>
              </tr>
            @empty
              <tr>
                <td colspan="4"
                  style="text-align:center; color:#aaa; padding:20px;">
                  Walang data pa.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="as-modal-footer">
        <button class="as-btn outline"
          onclick="closeModal('topModal')">Close</button>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script>
    // ── MODALS ─────────────────────────────────────────────────────────────────
    function openModal(id) {
      document.getElementById(id).classList.add('open');
    }

    function closeModal(id) {
      document.getElementById(id).classList.remove('open');
    }

    window.addEventListener('click', e => {
      document.querySelectorAll('.as-modal.open').forEach(m => {
        if (e.target === m) m.classList.remove('open');
      });
    });

    // ── DETAILS ────────────────────────────────────────────────────────────────
    function openDetailsModal(name, id, quiz, score, total, percentage) {
      document.getElementById('det-name').textContent = name;
      document.getElementById('det-id').textContent = 'ID: ' + id;
      document.getElementById('det-course').textContent = quiz;
      document.getElementById('det-score').textContent = score + '/' + total +
        ' (' + percentage + '%)';
      openModal('detailsModal');
    }

    // ── GRADE ──────────────────────────────────────────────────────────────────
    function calcResult() {
      const score = parseInt(document.getElementById('gradeScore').value);
      const text = document.getElementById('resultText');
      if (isNaN(score)) {
        text.textContent = '—';
        text.style.color = '#025628';
        return;
      }
      text.textContent = score >= 75 ? 'Passed ✓' : 'Failed ✗';
      text.style.color = score >= 75 ? '#025628' : '#A32D2D';
    }

    function saveGrade() {
      alert('Grade saved successfully!');
      closeModal('gradeModal');
    }

    // ── FILTERS ────────────────────────────────────────────────────────────────
    function applyFilters() {
      const course = document.getElementById('filterCourse').value.toLowerCase();
      const result = document.getElementById('filterResult').value.toLowerCase();
      const competency = document.getElementById('filterCompetency').value
        .toLowerCase();

      document.querySelectorAll('#assessmentTable tbody tr').forEach(row => {
        const show = (course === '' || row.cells[2].textContent.toLowerCase()
            .includes(course)) &&
          (result === '' || row.cells[3].textContent.toLowerCase().includes(
            result)) &&
          (competency === '' || row.cells[4].textContent.toLowerCase()
            .includes(competency));
        row.style.display = show ? '' : 'none';
      });
    }

    // ── ACTIONS ────────────────────────────────────────────────────────────────
    function deleteEntry(btn) {
      if (confirm('Delete this record?')) btn.closest('tr').remove();
    }

    function editAssessment(id) {
      alert('Editing grades for ID: ' + id);
    }

    function exportToExcel() {
      alert('Exporting assessment data...');
    }
  </script>
@endsection
