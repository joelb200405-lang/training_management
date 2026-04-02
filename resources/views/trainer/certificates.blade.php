@extends ('trainer.layout')

@section('title', 'Certificate')

@section('css')
    <link rel="stylesheet" href="{{ asset('stylesheet/certificates.css') }}">
@endsection

@section('content')
            <div class="panel-padding">
                <h2 class="panel-title">Certificates</h2>

                <section class="stats-grid">
                    <div class="stat-card"><h3>67</h3><p>Certificates Issued</p></div>
                    <div class="stat-card"><h3>07</h3><p>Pending Claim</p></div>
                    <div class="stat-card"><h3>67</h3><p>Monthly Graduates</p></div>
                    <div class="stat-card urgent"><h3>67</h3><p>Archive Size</p></div>
                </section>

                <div class="filter-controls">
                    <div class="dropdown-group">
                        <div class="filter-item">Filter by: Course <i class="fas fa-caret-down"></i></div>
                        <div class="filter-item">Filter by: Month <i class="fas fa-caret-down"></i></div>
                        <div class="filter-item">Filter by: Status <i class="fas fa-caret-down"></i></div>
                    </div>
                    <div class="selection-group">
                        <label class="custom-checkbox"><input type="checkbox"> <span>Select Multiple</span></label>
                        <label class="custom-checkbox"><input type="checkbox"> <span>Select All</span></label>
                    </div>
                </div>

                <div class="table-outline">
                    <table class="trainee-data-table">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Course</th>
                                <th>Barangay</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nelmida, Rheyan</td>
                                <td>Dressmaking</td>
                                <td>April 3, 2026</td>
                                <td>Claimed</td>
                                <td class="action-icons">
                                    <i class="fas fa-eye view-icon" onclick="openCertModal()" title="View Full Details"></i>
                                    <i class="fas fa-edit edit-icon" title="Edit Award Info"></i>
                                    <i class="fas fa-trash-alt delete-icon" title="Void Record"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="action-footer">
                    <button class="text-btn-add" onclick="openAddModal()">
                        <i class="fas fa-plus-square"></i> Issue New Certificate
                    </button>
                    <button class="pill-btn-export">Export Certificate</button>
                </div>
            </div>
        </main>
    </div>

    <div id="certificateModal" class="modal-overlay">
        <div class="modal-box wide-modal">
            <div class="modal-content-flex">
                <div class="modal-left-preview">
                    <h3 class="section-header">Certificate Preview</h3>
                    <div class="cert-frame">
                        <div class="cert-placeholder">
                            <img src="logo.png" alt="DCTC Logo" class="cert-logo-mini">
                            <p class="cert-text-type">CERTIFICATE OF COMPLETION</p>
                            <h2 class="cert-trainee-name">Nelmida, Rheyan</h2>
                            <p class="cert-text-detail">has successfully completed the course in</p>
                            <p class="cert-course-name">Dressmaking</p>
                            <div class="cert-footer-line"></div>
                            <p class="cert-control-no">Control No: DCTC-2026-88</p>
                        </div>
                    </div>
                    <p class="preview-note"><i class="fas fa-info-circle"></i> Verify spelling before re-printing.</p>
                </div>

                <div class="modal-right-info">
                    <div class="info-header">
                        <span class="control-badge">ID: DCTC-2026-88</span>
                        <h2 class="modal-title">Certificate Details</h2>
                    </div>

                    <div class="detail-group">
                        <h4 class="detail-label">Trainee Performance</h4>
                        <p class="detail-value">Final Grade: <span class="grade-pass">94% - Passed</span></p>
                    </div>

                    <div class="detail-group">
                        <h4 class="detail-label">Official Signatories</h4>
                        <ul class="signatory-list">
                            <li><i class="fas fa-pen-nib"></i> Hon. Jennifer Austria-Barzaga (Mayor)</li>
                            <li><i class="fas fa-user-tie"></i> Center Head Name</li>
                            <li><i class="fas fa-chalkboard-teacher"></i> Course Instructor</li>
                        </ul>
                    </div>

                    <div class="detail-group">
                        <h4 class="detail-label">Digital Status</h4>
                        <p class="detail-value status-ready"><i class="fas fa-check-circle"></i> Soft Copy (PDF) Generated</p>
                    </div>

                    <div class="modal-actions-grid">
                        <button class="modal-btn download-btn"><i class="fas fa-file-pdf"></i> Download PDF</button>
                        <button class="modal-btn email-btn"><i class="fas fa-paper-plane"></i> Send to Email</button>
                        <button class="modal-btn print-btn"><i class="fas fa-print"></i> Re-Print Physical</button>
                        <button class="modal-btn claim-btn" onclick="closeCertModal()"><i class="fas fa-check"></i> Mark as Claimed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addTraineeModal" class="modal-overlay">
        <div class="modal-box wide-modal">
            <div class="modal-content-flex">
                <div class="modal-right-info" style="border-right: 1px solid #eee;">
                    <h2 class="page-title-green" style="font-size: 22px;">Issue New Certificate</h2>
                    <form id="issueCertForm">
                        <div class="info-content">
                            <h3 class="section-header">1. Trainee Selection</h3>
                            <select class="form-input" id="traineeSelect" required>
                                <option value="" disabled selected>Search Passed Trainees...</option>
                                <option value="1">Nelmida, Rheyan (Grade: 94%)</option>
                                <option value="2">Bong, Marcos (Grade: 88%)</option>
                            </select>
                            <input type="text" class="form-input" placeholder="Course: Dressmaking" readonly style="background: #f9f9f9;">
                        </div>

                        <div class="info-content">
                            <h3 class="section-header">2. Official Record Details</h3>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" class="form-input" value="DCTC-2026-005" title="Control Number">
                                <input type="date" class="form-input" value="2026-03-31">
                            </div>
                            <select class="form-input" multiple style="height: 60px;">
                                <option selected>Hon. Jennifer Austria-Barzaga</option>
                                <option selected>Center Head Name</option>
                                <option>Course Instructor</option>
                            </select>
                        </div>

                        <div class="info-content">
                            <h3 class="section-header">3. Document Options</h3>
                            <select class="form-input">
                                <option>Certificate of Completion</option>
                                <option>Certificate of Appreciation</option>
                                <option>Special Recognition</option>
                            </select>
                            <textarea class="form-input" placeholder="Remarks/Honors (e.g. With Honors)" style="height: 50px;"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-left-preview" style="background: #fff;">
                    <h3 class="section-header">4. Live Preview</h3>
                    <div class="cert-frame" style="transform: scale(0.9); margin-top: 0;">
                        <div class="cert-placeholder" id="livePreviewBox">
                            <img src="logo.png" alt="Logo" style="width: 30px;">
                            <p style="font-size: 8px; margin: 5px 0;">CITY OF DASMARIÑAS</p>
                            <h4 style="color: var(--primary-green); margin: 10px 0; font-size: 14px;">[TRAINEE NAME]</h4>
                            <p style="font-size: 9px;">For successfully completing the course in</p>
                            <p style="font-weight: bold; font-size: 11px;">[COURSE NAME]</p>
                        </div>
                    </div>
                    
                    <div class="modal-actions-grid" style="margin-top: 10px;">
                        <button class="modal-btn print-btn" style="grid-column: span 2;">
                            <i class="fas fa-file-pdf"></i> Save & Generate PDF
                        </button>
                        <button class="modal-btn email-btn">
                            <i class="fas fa-print"></i> Save & Print
                        </button>
                        <button class="modal-btn download-btn" onclick="closeAddModal()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
   
    @section('scripts')
    <script>
        function openAddModal() { document.getElementById('addTraineeModal').style.display = 'flex'; }
        function closeAddModal() { document.getElementById('addTraineeModal').style.display = 'none'; }
        function openCertModal() { document.getElementById('certificateModal').style.display = 'flex'; }
        function closeCertModal() { document.getElementById('certificateModal').style.display = 'none'; }

        document.addEventListener('DOMContentLoaded', function() {
            const traineeSelect = document.getElementById('traineeSelect');
            const previewName = document.querySelector('#livePreviewBox h4');

            if (traineeSelect) {
                traineeSelect.addEventListener('change', function() {
                    const selectedText = this.options[this.selectedIndex].text;
                    const fullName = selectedText.split(' (')[0];
                    if (previewName) {
                        previewName.innerText = fullName.toUpperCase();
                        previewName.style.color = "#004d26";
                        previewName.style.borderBottom = "1px dashed #ccc";
                    }
                });
            }

            window.onclick = function(event) {
                if (event.target.classList.contains('modal-overlay')) {
                    event.target.style.display = 'none';
                }
            };
        });
    </script>
@endsection