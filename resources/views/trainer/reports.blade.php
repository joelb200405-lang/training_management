@extends('trainer.layout')

@section('title', 'Reports')

@section('css')
<link rel="stylesheet" href="{{ asset('stylesheet/reports.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
<div class="panel-padding">
    <h2 class="panel-title" style="padding:0 0 20px;">Reports Analytics</h2>

    <section class="stats-grid" style="margin:0 0 24px;">
        <div class="stat-card"><h3>67%</h3><p>Graduation Rate</p></div>
        <div class="stat-card"><h3>52</h3><p>Employment Ready</p></div>
        <div class="stat-card"><h3>Sabang</h3><p>Top Barangay Reach</p></div>
        <div class="stat-card"><h3>60/70</h3><p>Gender Split (F/M)</p></div>
    </section>

    <div class="reports-left-workspace">

        <div class="report-filter-card">
            <h3 class="section-header-mini">Report Generator</h3>
            <div class="filter-grid">
                <select class="report-select" id="reportType">
                    <option>Enrollment Summary</option>
                    <option>Assessment Results</option>
                    <option>Certificate Registry</option>
                </select>
                <select class="report-select" id="courseSelect">
                    <option>All Courses</option>
                    <option>Dressmaking</option>
                    <option>Nail Care</option>
                </select>
                <input type="month" class="report-select" id="dateFilter" value="2026-03">
                <button class="btn-generate" onclick="updatePreview()">Generate</button>
            </div>
        </div>

        <div class="preview-container">
            <div class="preview-header" style="padding:12px 16px;background:#fafff8;border-bottom:1px solid #eee;">
                <span id="recordStatus">Showing <strong>45 records</strong> for March 2026</span>
            </div>
            <table class="preview-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody id="previewBody">
                    <tr>
                        <td>Nelmida, Rheyan</td>
                        <td>Dressmaking</td>
                        <td>04/01/2026</td>
                        <td><span class="res-passed">Passed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="analytics-charts-row">
            <div class="chart-card">
                <h3 class="section-header-mini">Course Distribution</h3>
                <div class="chart-box"><canvas id="coursePieChart"></canvas></div>
            </div>
            <div class="chart-card">
                <h3 class="section-header-mini">Monthly Graduates</h3>
                <div class="chart-box"><canvas id="gradBarChart"></canvas></div>
            </div>
        </div>

        <div class="chart-card wide-card">
            <h3 class="section-header-mini">Enrollment Growth Trends</h3>
            <div class="chart-box-tall"><canvas id="enrollLineChart"></canvas></div>
        </div>

        <div class="signature-section">
            <div class="sig-box">
                <p>PREPARED BY:</p>
                <div class="sig-line"></div>
                <p>Ma. Michaela S. Bocita</p>
            </div>
            <div class="sig-box">
                <p>NOTED BY:</p>
                <div class="sig-line"></div>
                <p>Center Head / City Official</p>
            </div>
        </div>

        <div class="export-footer">
            <button class="btn-export excel"><i class="fas fa-file-excel"></i> Export Excel</button>
            <button class="btn-export pdf"><i class="fas fa-file-pdf"></i> Export PDF</button>
            <button class="btn-export print" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function updatePreview() {
    const btn = document.querySelector('.btn-generate');
    const status = document.getElementById('recordStatus');
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    btn.disabled = true;

    setTimeout(() => {
        const count = Math.floor(Math.random() * 60) + 15;
        status.innerHTML = `Showing <strong>${count} records</strong> for the selected criteria.`;
        btn.innerHTML = 'Generate Preview';
        btn.disabled = false;
        alert("Report Preview Updated Successfully!");
    }, 1000);
}

function exportData(type) {
    if (type === 'PDF') {
        if (confirm("Generate official report with the City Mayor's Letterhead?")) {
            window.print();
        }
    } else {
        alert(`Data successfully converted to ${type} and saved to your Downloads folder.`);
    }
}

/**
 * SECTION 1: FILTER & BUTTON LOGIC (Existing Code)
 * This handles your "Generate Preview" and "Export" buttons
 */
function updatePreview() {
    const btn = document.querySelector('.btn-generate');
    const status = document.getElementById('recordStatus');
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    btn.disabled = true;

    setTimeout(() => {
        const count = Math.floor(Math.random() * 60) + 15;
        status.innerHTML = `Showing <strong>${count} records</strong> for the selected criteria.`;
        btn.innerHTML = 'Generate Preview';
        btn.disabled = false;
        alert("Report Preview Updated!");
    }, 1000);
}

function exportData(type) {
    if (type === 'PDF') {
        if (confirm("Generate official report with the City Mayor's Letterhead?")) {
            window.print();
        }
    } else {
        alert(`Data successfully converted to ${type} and saved to Downloads.`);
    }
}

/**
 * SECTION 2: CHART INITIALIZATION (New Code)
 * We wrap this in an Event Listener so it waits for the page to load
 */
document.addEventListener('DOMContentLoaded', function() {
    // Shared Theme Colors from your CSS
    const primaryGreen = '#004d26';
    const secondaryGreen = '#007d3d';
    const softGreen = '#e8f5e9';
    const accentYellow = '#f8f16a';

    // 1. PIE CHART: Course Distribution
    const ctxPie = document.getElementById('coursePieChart');
    if (ctxPie) {
        new Chart(ctxPie.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Dressmaking', 'Nail Care', 'Cookery', 'Welding'],
                datasets: [{
                    data: [40, 25, 20, 15],
                    backgroundColor: [primaryGreen, secondaryGreen, '#2e7d32', accentYellow],
                    borderWidth: 2
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // 2. BAR CHART: Monthly Graduates
    const ctxBar = document.getElementById('gradBarChart');
    if (ctxBar) {
        new Chart(ctxBar.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr'],
                datasets: [{
                    label: 'Graduates',
                    data: [45, 52, 67, 48],
                    backgroundColor: primaryGreen,
                    borderRadius: 8
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // 3. LINE GRAPH: Enrollment Growth
    const ctxLine = document.getElementById('enrollLineChart');
    if (ctxLine) {
        new Chart(ctxLine.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'New Enrollees',
                    data: [120, 150, 180, 170, 210],
                    borderColor: primaryGreen,
                    backgroundColor: 'rgba(0, 77, 38, 0.1)', // Matches softGreen with transparency
                    fill: true,
                    tension: 0.4 
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }
});
</script>
@endsection