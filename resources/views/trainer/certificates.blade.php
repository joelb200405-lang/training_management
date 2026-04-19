@extends('trainer.layout')

@section('title', 'Certificates')

@section('css')
<link rel="stylesheet" href="{{ asset('stylesheet/certificates.css') }}">
@endsection

@section('content')
<div class="content-padding" style="padding:0 0 20px;">
    <h2 class="panel-title">Certificates</h2>

    <section class="stats-grid">
        <div class="stat-card"><h3>67</h3><p>Certificates Issued</p></div>
        <div class="stat-card"><h3>07</h3><p>Pending Claim</p></div>
        <div class="stat-card"><h3>67</h3><p>Monthly Graduates</p></div>
        <div class="stat-card urgent"><h3>67</h3><p>Archive Size</p></div>
    </section>

    <div class="filter-controls" style="display:flex;justify-content:space-between;padding:0 50px 14px;align-items:center;">
        <div style="display:flex;gap:20px;">
            <select class="filter-dropdown">
                <option>Filter by: Course</option>
            </select>
            <select class="filter-dropdown">
                <option>Filter by: Month</option>
            </select>
            <select class="filter-dropdown">
                <option>Filter by: Status</option>
            </select>
        </div>
        <div style="display:flex;gap:16px;align-items:center;font-size:13px;">
            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-weight:600;color:var(--primary-green);">
                <input type="checkbox" id="toggleMultiple"> Select Multiple
            </label>
            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-weight:600;color:var(--primary-green);">
                <input type="checkbox" id="selectAll"> Select All
            </label>
        </div>
    </div>

    <div class="table-outline">
        <table class="trainee-data-table" id="certTable">
            <thead>
                <tr>
                    <th class="select-col hidden"><i class="fas fa-check-square"></i></th>
                    <th>Fullname</th>
                    <th>Course</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="select-col hidden"><input type="checkbox" class="row-checkbox"></td>
                    <td>Nelmida, Rheyan</td>
                    <td>Dressmaking</td>
                    <td>April 3, 2026</td>
                    <td>Claimed</td>
                    <td class="action-icons">
                        <i class="fas fa-eye view-icon" onclick="openCertModal('Nelmida, Rheyan','Dressmaking','DCTC-2026-88')"></i>
                        <i class="fas fa-edit edit-icon"></i>
                        <i class="fas fa-trash-alt delete-icon" onclick="deleteCert(this)"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="display:flex;justify-content:flex-end;align-items:center;gap:24px;padding:20px 50px;">
        <button class="text-btn-add" onclick="openAddModal()">
            <i class="fas fa-plus-square"></i> Issue New Certificate
        </button>
        <button class="export-pill-btn">Export Certificate</button>
    </div>
</div>

{{-- View Certificate Modal --}}
<div id="certificateModal" class="modal-overlay">
    <div style="background:white;border-radius:20px;width:860px;max-width:94%;height:520px;overflow:hidden;display:flex;">
        <div style="flex:1.2;background:#f8f9fa;padding:28px;text-align:center;border-right:1px solid #eee;display:flex;flex-direction:column;">
            <h3 style="color:var(--primary-green);font-size:14px;font-weight:700;margin-bottom:16px;">Certificate Preview</h3>
            <div id="printableCert" style="background:white;border:4px double var(--primary-green);padding:20px;flex:1;display:flex;align-items:center;justify-content:center;">
                <div style="text-align:center;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:45px;margin-bottom:8px;">
                    <p style="font-size:10px;letter-spacing:.1em;color:#888;margin:0 0 8px;">CERTIFICATE OF COMPLETION</p>
                    <h2 id="vName" style="color:var(--primary-green);font-size:20px;margin:0 0 6px;">Nelmida, Rheyan</h2>
                    <p style="font-size:11px;color:#666;margin:0 0 6px;">has successfully completed the course in</p>
                    <p id="vCourse" style="font-weight:700;font-size:14px;color:var(--text-dark);margin:0 0 12px;">Dressmaking</p>
                    <hr style="border:1px solid #ddd;margin:10px 0;">
                    <p id="vID" style="font-size:10px;color:#888;margin:0;">Control No: DCTC-2026-88</p>
                </div>
            </div>
        </div>
        <div style="flex:1;padding:28px;display:flex;flex-direction:column;">
            <h2 style="color:var(--primary-green);font-size:18px;margin:0 0 20px;">Certificate Details</h2>
            <div style="margin-bottom:16px;">
                <span style="font-size:11px;color:#888;display:block;margin-bottom:4px;">Trainee Performance</span>
                <p style="color:#2e7d32;font-weight:700;font-size:15px;margin:0;">94% — Passed</p>
            </div>
            <div style="margin-bottom:20px;">
                <span style="font-size:11px;color:#888;display:block;margin-bottom:8px;">Official Signatories</span>
                <p style="font-size:13px;color:#444;margin:4px 0;"><i class="fas fa-pen-nib" style="margin-right:6px;color:var(--primary-green);"></i> Hon. Jennifer Austria-Barzaga</p>
                <p style="font-size:13px;color:#444;margin:4px 0;"><i class="fas fa-user-tie" style="margin-right:6px;color:var(--primary-green);"></i> Center Head Name</p>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:auto;">
                <button onclick="handleDownload()" style="background:#555;color:white;border:none;padding:10px;border-radius:10px;font-weight:600;cursor:pointer;">Download PDF</button>
                <button onclick="handlePrint()" style="background:var(--primary-green);color:white;border:none;padding:10px;border-radius:10px;font-weight:600;cursor:pointer;">Re-Print</button>
            </div>
            <button onclick="document.getElementById('certificateModal').style.display='none'" style="margin-top:10px;background:#eee;border:none;padding:10px;border-radius:10px;cursor:pointer;font-weight:600;">Close</button>
        </div>
    </div>
</div>

{{-- Issue New Certificate Modal --}}
<div id="addTraineeModal" class="modal-overlay">
    <div style="background:white;border-radius:20px;width:860px;max-width:94%;height:520px;overflow:hidden;display:flex;">
        <div style="flex:1;padding:28px;display:flex;flex-direction:column;border-right:1px solid #eee;">
            <h2 style="color:var(--primary-green);font-size:18px;margin:0 0 16px;">Issue New Certificate</h2>
            <div style="margin-bottom:14px;">
                <label style="font-size:13px;font-weight:700;color:var(--primary-green);display:block;margin-bottom:6px;">1. Trainee Selection</label>
                <select id="traineeSelect" onchange="updateLivePreview()" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-size:13px;">
                    <option value="" disabled selected>Search Trainee...</option>
                    <option data-course="Dressmaking">Nelmida, Rheyan (94%)</option>
                    <option data-course="Nail Care">Bong, Marcos (88%)</option>
                </select>
            </div>
            <div style="margin-bottom:14px;">
                <label style="font-size:13px;font-weight:700;color:var(--primary-green);display:block;margin-bottom:6px;">2. Record Details</label>
                <input type="text" id="certID" placeholder="Control Number" onchange="updateLivePreview()" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-size:13px;margin-bottom:8px;">
                <input type="date" value="2026-03-31" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-size:13px;">
            </div>
            <div style="margin-bottom:14px;">
                <label style="font-size:13px;font-weight:700;color:var(--primary-green);display:block;margin-bottom:6px;">3. Document Options</label>
                <select style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-size:13px;margin-bottom:8px;">
                    <option>Certificate of Completion</option>
                </select>
                <textarea placeholder="Remarks" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-size:13px;resize:none;height:56px;"></textarea>
            </div>
        </div>
        <div style="flex:1.2;background:#f8f9fa;padding:28px;text-align:center;display:flex;flex-direction:column;">
            <h3 style="color:var(--primary-green);font-size:14px;font-weight:700;margin-bottom:12px;">Live Preview</h3>
            <div style="background:white;border:4px double var(--primary-green);padding:20px;flex:1;display:flex;align-items:center;justify-content:center;transform:scale(0.88);margin:-10px;">
                <div>
                    <img src="{{ asset('images/logo.png') }}" alt="" style="width:35px;margin-bottom:6px;">
                    <h4 id="pName" style="color:var(--primary-green);margin:8px 0 4px;">[NAME]</h4>
                    <p id="pCourse" style="font-weight:700;font-size:13px;margin:0;">[COURSE]</p>
                </div>
            </div>
            <div style="display:flex;flex-direction:column;gap:8px;margin-top:16px;">
                <button onclick="alert('Saving...')" style="background:var(--primary-green);color:white;border:none;padding:10px;border-radius:10px;font-weight:600;cursor:pointer;">Save &amp; Issue</button>
                <button onclick="closeAddModal()" style="background:#eee;border:none;padding:10px;border-radius:10px;cursor:pointer;font-weight:600;">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openAddModal()  { document.getElementById('addTraineeModal').style.display  = 'flex'; }
function closeAddModal() { document.getElementById('addTraineeModal').style.display  = 'none'; }
function openCertModal(n, c, i) {
    document.getElementById('vName').innerText   = n;
    document.getElementById('vCourse').innerText = c;
    document.getElementById('vID').innerText     = "Control No: " + i;
    document.getElementById('certificateModal').style.display = 'flex';
}
function updateLivePreview() {
    const s = document.getElementById('traineeSelect');
    const n = s.value.split(' (')[0];
    const c = s.options[s.selectedIndex].getAttribute('data-course');
    document.getElementById('pName').innerText   = n.toUpperCase() || "[NAME]";
    document.getElementById('pCourse').innerText = c || "[COURSE]";
}
function deleteCert(btn) { if(confirm("Delete this certificate?")) btn.closest('tr').remove(); }
function handleDownload() { alert("Building PDF..."); }
function handlePrint() {
    const content = document.getElementById('printableCert').innerHTML;
    const win = window.open('','','height=700,width=900');
    win.document.write('<html><head><style>body{text-align:center;padding:50px;font-family:sans-serif;}</style></head><body>' + content + '</body></html>');
    win.document.close(); win.print();
}
window.onclick = e => { if (e.target.classList.contains('modal-overlay')) e.target.style.display = "none"; };
</script>
@endsection