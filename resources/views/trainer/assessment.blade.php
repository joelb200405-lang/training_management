@extends('trainer.layout')

@section('title', 'Assessment')

@section('css')
<link rel="stylesheet" href="{{ asset('stylesheet/assessment.css') }}">
@endsection

@section('content')
<h2 class="panel-title">Assessment</h2>

<section class="stats-grid">
    <div class="stat-card"><h3>07</h3><p>Pending Grading</p></div>
    <div class="stat-card"><h3>92%</h3><p>Average Class Score</p></div>
    <div class="stat-card"><h3>97%</h3><p>Passing Rate</p></div>
    <div class="stat-card urgent">
        <h3>96%</h3><p>Top Performers</p>
        <span class="card-view-link" onclick="openTopPerformersModal()">view</span>
    </div>
</section>

<div class="filter-row">
    <select class="filter-dropdown" id="filterCourse">
        <option value="">Filter by: Course</option>
        <option value="Nail Care">Nail Care</option>
        <option value="Candle Making">Candle Making</option>
    </select>
    <select class="filter-dropdown" id="filterResult">
        <option value="">Filter by: Activities</option>
        <option value="Complete">Complete</option>
        <option value="Incomplete">Incomplete</option>
    </select>
    <select class="filter-dropdown" id="filterCompetency">
        <option value="">Filter by: Competency</option>
        <option value="Competent">Competent</option>
        <option value="Not Yet Competent">Not Yet Competent</option>
    </select>
</div>

<div class="table-outline">
    <table class="trainee-data-table" id="assessmentTable">
        <thead>
            <tr>
                <th>Trainee ID</th>
                <th>Fullname</th>
                <th>Course</th>
                <th>Activities</th>
                <th>Competency Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2023-2-0018</td>
                <td>Bong, Marcos</td>
                <td>Nail Care</td>
                <td class="res-failed">Incomplete</td>
                <td>Competent</td>
                <td class="action-icons">
                    <i class="fas fa-eye view" onclick="openAssessmentDetails('Bong, Marcos','2023-2-0018','Nail Care')"></i>
                    <i class="fas fa-edit edit" onclick="editAssessment('2023-2-0018')"></i>
                    <i class="fas fa-trash-alt delete" onclick="deleteEntry(this)"></i>
                </td>
            </tr>
            <tr>
                <td>2023-2-0019</td>
                <td>Ramos, Roshian</td>
                <td>Candle Making</td>
                <td class="res-failed">Incomplete</td>
                <td>Not Yet Competent</td>
                <td class="action-icons">
                    <i class="fas fa-eye view" onclick="openAssessmentDetails('Ramos, Roshian','2023-2-0019','Candle Making')"></i>
                    <i class="fas fa-edit edit" onclick="editAssessment('2023-2-0019')"></i>
                    <i class="fas fa-trash-alt delete" onclick="deleteEntry(this)"></i>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="bottom-controls">
    <button class="add-grade-btn" onclick="openGradeModal()"><i class="fas fa-plus"></i> Add New Grade</button>
    <button class="export-pill-btn" onclick="exportToExcel()">Export to Excel</button>
</div>

{{-- Performance Details Modal --}}
<div id="profileModal" class="modal-overlay">
    <div class="modal-box profile-modal" style="width:480px;max-width:92%;text-align:center;">
        <h2 style="color:var(--primary-green);margin-bottom:12px;">Performance Details</h2>
        <div class="profile-photo-circle"><i class="fas fa-chart-line"></i></div>
        <h2 id="detName" style="color:var(--primary-green);font-size:22px;margin:8px 0 2px;">Name Here</h2>
        <p id="detID" style="color:#666;font-size:13px;margin-bottom:14px;">ID: 0000</p>
        <hr class="modal-divider">
        <div style="text-align:left;">
            <span class="section-badge">Assessment Scores</span>
            <div style="display:flex;justify-content:space-between;padding:6px 20px;font-size:14px;"><span>Quiz 1:</span><strong>85/100</strong></div>
            <div style="display:flex;justify-content:space-between;padding:6px 20px;font-size:14px;"><span>Quiz 2:</span><strong>92/100</strong></div>
            <br>
            <span class="section-badge">Finished Activities</span>
            <p style="text-align:left;padding-left:20px;font-size:13px;color:#2e7d32;margin:5px 0;"><i class="fas fa-check-circle"></i> Lesson 1 Modules</p>
            <p style="text-align:left;padding-left:20px;font-size:13px;color:#2e7d32;margin:5px 0;"><i class="fas fa-check-circle"></i> Lab Activity 1</p>
            <br>
            <span class="section-badge urgent-badge">Missing Activities</span>
            <p style="text-align:left;padding-left:20px;font-size:13px;color:#c62828;margin:5px 0;"><i class="fas fa-times-circle"></i> Final Project Draft</p>
        </div>
        <div class="modal-footer-centered">
            <button class="close-profile-btn" onclick="closeProfile()">Close View</button>
        </div>
    </div>
</div>

{{-- Add Grade Modal --}}
<div id="addGradeModal" class="modal-overlay">
    <div class="modal-box" style="width:440px;max-width:92%;text-align:center;">
        <h2 style="color:var(--primary-green);margin-bottom:16px;">Add New Grade</h2>
        <form id="gradeForm">
            <span class="section-badge">Grading Input</span>
            <select name="trainee_id" class="form-input" required style="width:100%;padding:11px;margin:10px 0;border:1px solid #ddd;border-radius:8px;font-size:13px;">
                <option value="" disabled selected>Select Trainee</option>
                <option value="2023-2-0018">Bong, Marcos</option>
                <option value="2023-2-0019">Ramos, Roshian</option>
            </select>
            <select name="assessment_name" class="form-input" required style="width:100%;padding:11px;margin:10px 0;border:1px solid #ddd;border-radius:8px;font-size:13px;">
                <option value="" disabled selected>Select Assessment</option>
                <option>Quiz 1</option>
                <option>Quiz 2</option>
                <option>Final Project</option>
            </select>
            <input type="number" id="inputScore" name="score" placeholder="Enter Score (0-100)" style="width:100%;padding:11px;margin:10px 0;border:1px solid #ddd;border-radius:8px;font-size:13px;" required oninput="calculateResult()">
            <div style="padding:10px;background:#f8f9fa;border-radius:8px;border-left:4px solid var(--primary-green);font-size:15px;margin-top:8px;">
                Result: <strong id="displayResult">---</strong>
                <input type="hidden" name="calculated_result" id="hiddenResult">
            </div>
            <div style="display:flex;gap:10px;justify-content:center;margin-top:18px;">
                <button type="submit" class="export-pill-btn">Save Grade</button>
                <button type="button" onclick="closeGradeModal()" style="background:#eee;border:none;padding:10px 24px;border-radius:25px;cursor:pointer;font-weight:600;">Cancel</button>
            </div>
        </form>
    </div>
</div>

{{-- Top Performers Modal --}}
<div id="topPerformersModal" class="modal-overlay">
    <div class="modal-box" style="width:520px;max-width:92%;text-align:center;">
        <h2 style="color:var(--urgent-red);margin-bottom:16px;">Top 5 Performers</h2>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th style="border-bottom:2px solid var(--primary-green);padding:10px;color:var(--primary-green);text-align:left;">Rank</th>
                    <th style="border-bottom:2px solid var(--primary-green);padding:10px;color:var(--primary-green);text-align:left;">Fullname</th>
                    <th style="border-bottom:2px solid var(--primary-green);padding:10px;color:var(--primary-green);text-align:left;">Course</th>
                    <th style="border-bottom:2px solid var(--primary-green);padding:10px;color:var(--primary-green);text-align:left;">Grade</th>
                </tr>
            </thead>
            <tbody>
                <tr><td style="padding:11px 10px;border-bottom:1px solid #eee;"><i class="fas fa-medal" style="color:#FFD700;margin-right:6px;"></i>1</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">Santos, Maria</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">Nail Care</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">99%</td></tr>
                <tr><td style="padding:11px 10px;border-bottom:1px solid #eee;"><i class="fas fa-medal" style="color:#C0C0C0;margin-right:6px;"></i>2</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">Cruz, Juan</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">Candle Making</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">98%</td></tr>
                <tr><td style="padding:11px 10px;border-bottom:1px solid #eee;"><i class="fas fa-medal" style="color:#CD7F32;margin-right:6px;"></i>3</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">Reyes, Ana</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">Nail Care</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">97%</td></tr>
                <tr><td style="padding:11px 10px;border-bottom:1px solid #eee;">4</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">Del Rosario, Paolo</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">Nail Care</td><td style="padding:11px 10px;border-bottom:1px solid #eee;">96%</td></tr>
                <tr><td style="padding:11px 10px;">5</td><td style="padding:11px 10px;">Bong, Marcos</td><td style="padding:11px 10px;">Nail Care</td><td style="padding:11px 10px;">96%</td></tr>
            </tbody>
        </table>
        <div class="modal-footer-centered">
            <button class="close-profile-btn" onclick="closeTopPerformersModal()">Close</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openTopPerformersModal() { document.getElementById("topPerformersModal").style.display = "flex"; }
function closeTopPerformersModal() { document.getElementById("topPerformersModal").style.display = "none"; }
function openGradeModal()  { document.getElementById("addGradeModal").style.display = "flex"; }
function closeGradeModal() {
    document.getElementById("addGradeModal").style.display = "none";
    document.getElementById("gradeForm").reset();
    document.getElementById("displayResult").innerText = "---";
}
function openAssessmentDetails(name, id) {
    document.getElementById("detName").innerText = name;
    document.getElementById("detID").innerText   = "ID: " + id;
    document.getElementById("profileModal").style.display = "flex";
}
function closeProfile() { document.getElementById("profileModal").style.display = "none"; }
function calculateResult() {
    const score   = document.getElementById('inputScore').value;
    const display = document.getElementById('displayResult');
    const hidden  = document.getElementById('hiddenResult');
    if (score === "") { display.innerText = "---"; display.style.color = "inherit"; return; }
    if (score >= 75) { display.innerText = "Passed"; display.style.color = "#28a745"; hidden.value = "Passed"; }
    else             { display.innerText = "Failed"; display.style.color = "#d32f2f"; hidden.value = "Failed"; }
}
function deleteEntry(btn) { if(confirm("Delete this record?")) btn.closest('tr').remove(); }
function editAssessment(id) { alert("Editing Grades for ID: " + id); }
function exportToExcel() { alert("Exporting Assessment Data..."); }

document.querySelectorAll('.filter-dropdown').forEach(select => {
    select.addEventListener('change', function() {
        const course      = document.getElementById('filterCourse').value.toLowerCase();
        const result      = document.getElementById('filterResult').value.toLowerCase();
        const competency  = document.getElementById('filterCompetency').value.toLowerCase();
        document.querySelectorAll('#assessmentTable tbody tr').forEach(row => {
            const show = (course     === "" || row.cells[2].innerText.toLowerCase().includes(course))     &&
                         (result     === "" || row.cells[3].innerText.toLowerCase().includes(result))     &&
                         (competency === "" || row.cells[4].innerText.toLowerCase().includes(competency));
            row.style.display = show ? "" : "none";
        });
    });
});

window.onclick = e => { if (e.target.classList.contains('modal-overlay')) e.target.style.display = "none"; };
</script>
@endsection