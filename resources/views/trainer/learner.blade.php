@extends('trainer.layout')

@section('title', 'Trainees')

@section('css')
<link rel="stylesheet" href="{{ asset('stylesheet/learner.css') }}">
@endsection

@section('content')
<h2 class="panel-title">Trainees</h2>

<section class="stats-grid">
    <div class="stat-card"><h3>67</h3><p>Total Registered</p></div>
    <div class="stat-card"><h3>67</h3><p>Currently Enrolled</p></div>
    <div class="stat-card"><h3>67</h3><p>Certified Graduates</p></div>
    <div class="stat-card urgent"><h3>07</h3><p>Urgent Assessments</p></div>
</section>

<div class="filter-row">
    <select class="filter-dropdown" id="filterCourse">
        <option value="">Filter by: Course</option>
        <option value="Nail Care">Nail Care</option>
        <option value="Candle Making">Candle Making</option>
    </select>
    <select class="filter-dropdown" id="filterBarangay">
        <option value="">Filter by: Barangay</option>
        <option value="Salitran II">Salitran II</option>
        <option value="Sabang">Sabang</option>
    </select>
    <select class="filter-dropdown" id="filterStatus">
        <option value="">Filter by: Status</option>
        <option value="Active">Active</option>
        <option value="Waitlisted">Waitlisted</option>
    </select>
</div>

<div class="table-outline">
    <table class="trainee-data-table" id="traineeTable">
        <thead>
            <tr>
                <th>Trainee ID</th>
                <th>Fullname</th>
                <th>Course</th>
                <th>Barangay</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2023-2-0018</td>
                <td class="name">Bong, Marcos</td>
                <td class="course">Nail Care</td>
                <td>Salitran II</td>
                <td class="status-active">Active</td>
                <td class="action-icons">
                    <i class="fas fa-eye view" onclick="openProfile('Bong, Marcos','2023-2-0018','Salitran II, Dasmariñas, Cavite','Nail Care')"></i>
                    <i class="fas fa-edit edit" onclick="editTrainee('2023-2-0018')"></i>
                    <i class="fas fa-trash-alt delete" onclick="deleteTrainee(this)"></i>
                </td>
            </tr>
            <tr>
                <td>2023-2-0019</td>
                <td class="name">Ramos, Roshian</td>
                <td class="course">Candle Making</td>
                <td>Sabang</td>
                <td class="status-wait">Waitlisted</td>
                <td class="action-icons">
                    <i class="fas fa-eye view" onclick="openProfile('Ramos, Roshian','2023-2-0019','Sabang, Dasmariñas, Cavite','Candle Making')"></i>
                    <i class="fas fa-edit edit" onclick="editTrainee('2023-2-0019')"></i>
                    <i class="fas fa-trash-alt delete" onclick="deleteTrainee(this)"></i>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="bottom-controls">
    <button class="export-pill-btn" onclick="exportToExcel()">Export to Excel</button>
</div>

{{-- Profile Modal --}}
<div id="profileModal" class="modal-overlay">
    <div class="modal-box profile-modal">
        <h2 class="modal-title" style="color:var(--primary-green);margin-bottom:12px;">Trainee Profile</h2>
        <div class="profile-photo-circle"><i class="fas fa-user"></i></div>
        <h2 id="profName" style="color:var(--primary-green);font-size:22px;margin:8px 0 2px;">Name Here</h2>
        <p id="profID" style="color:#666;font-size:13px;margin-bottom:14px;">ID: 0000</p>
        <hr class="modal-divider">
        <div style="text-align:left;padding:0 8px;">
            <div style="margin-bottom:16px;">
                <span class="section-badge">Personal Info</span>
                <p style="font-size:14px;margin:6px 0;color:#444;"><strong>Address:</strong> <span id="profAddr">—</span></p>
                <p style="font-size:14px;margin:6px 0;color:#444;"><strong>Course:</strong> <span id="profCourse">—</span></p>
            </div>
            <div>
                <span class="section-badge">Documents</span>
                <p style="font-size:13px;color:#2e7d32;margin:6px 0;"><i class="fas fa-check-circle"></i> 2x2 Picture</p>
                <p style="font-size:13px;color:#c62828;margin:6px 0;"><i class="fas fa-times-circle"></i> Valid ID (Missing)</p>
            </div>
        </div>
        <div class="modal-footer-centered">
            <button class="close-profile-btn" onclick="closeProfile()">Close Profile</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openProfile(name, id, addr, course) {
    document.getElementById("profName").innerText = name;
    document.getElementById("profID").innerText   = "ID: " + id;
    document.getElementById("profAddr").innerText   = addr;
    document.getElementById("profCourse").innerText = course;
    document.getElementById("profileModal").style.display = "flex";
}
function closeProfile() { document.getElementById("profileModal").style.display = "none"; }
function deleteTrainee(btn) { if(confirm("Are you sure?")) btn.closest('tr').remove(); }
function editTrainee(id) { alert("Editing ID: " + id); }
function exportToExcel() { alert("Exporting to Excel..."); }

document.querySelectorAll('.filter-dropdown').forEach(select => {
    select.addEventListener('change', function() {
        const course  = document.getElementById('filterCourse').value.toLowerCase();
        const brgy    = document.getElementById('filterBarangay').value.toLowerCase();
        const status  = document.getElementById('filterStatus').value.toLowerCase();
        document.querySelectorAll('#traineeTable tbody tr').forEach(row => {
            const show = (course  === "" || row.cells[2].innerText.toLowerCase().includes(course))  &&
                         (brgy    === "" || row.cells[3].innerText.toLowerCase().includes(brgy))    &&
                         (status  === "" || row.cells[4].innerText.toLowerCase().includes(status));
            row.style.display = show ? "" : "none";
        });
    });
});

window.onclick = e => { if (e.target.classList.contains('modal-overlay')) e.target.style.display = "none"; };
</script>
@endsection