@extends('trainer.layout')

@section('title', 'Settings')

@section('css')
<link rel="stylesheet" href="{{ asset('stylesheet/settings.css') }}">
@endsection

@section('content')
<div class="panel-padding">
    <h2 class="panel-title" style="padding:0 0 20px;">Settings</h2>

    <div class="settings-card-frame">
        <nav class="settings-sidebar">
            <button class="nav-tab active" onclick="openTab(event, 'account')">
                <i class="fas fa-user"></i> Profile &amp; Account
            </button>
            <button class="nav-tab" onclick="openTab(event, 'institution')">
                <i class="fas fa-building"></i> Institution Info
            </button>
            <button class="nav-tab" onclick="openTab(event, 'config')">
                <i class="fas fa-cogs"></i> System Config
            </button>
            <button class="nav-tab" onclick="openTab(event, 'users')">
                <i class="fas fa-users"></i> User Management
            </button>
            <button class="nav-tab" onclick="openTab(event, 'appearance')">
                <i class="fas fa-palette"></i> Appearance
            </button>
        </nav>

        <div class="settings-body-area">
            <h3 class="center-title">Institutional Settings</h3>

            <div id="account" class="tab-panel active">
                <div class="form-row">
                    <label>Full Name</label>
                    <input type="text" class="custom-input" value="Michaela S. Bocita">
                </div>
                <div class="form-row">
                    <label>Employee ID</label>
                    <input type="text" class="custom-input" value="DCTC-2026-001" readonly style="background:#f9f9f9;">
                </div>
                <div class="form-row">
                    <label>Password</label>
                    <input type="password" class="custom-input" placeholder="Enter New Password">
                </div>
                <div class="form-row">
                    <label>Activity</label>
                    <button class="btn-action-outline">View My Recent Actions</button>
                </div>
            </div>

            <div id="institution" class="tab-panel">
                <div class="form-row">
                    <label>Center Name</label>
                    <input type="text" class="custom-input" value="Dasmariñas City Training Center">
                </div>
                <div class="form-row">
                    <label>Office Address</label>
                    <input type="text" class="custom-input" placeholder="Barangay Burol Main, Cavite">
                </div>
                <div class="form-row">
                    <label>City Logo</label>
                    <div class="custom-input-file">
                        <span>Upload City Seal (PNG)</span>
                        <i class="fas fa-upload"></i>
                    </div>
                </div>
                <div class="form-row">
                    <label>Signatures</label>
                    <div class="custom-input-file">
                        <span>Upload Head Signature</span>
                        <i class="fas fa-file-signature"></i>
                    </div>
                </div>
            </div>

            <div id="config" class="tab-panel">
                <div class="form-row">
                    <label>Passing Grade</label>
                    <input type="number" class="custom-input" value="75">
                </div>
                <div class="form-row">
                    <label>Serial Prefix</label>
                    <input type="text" class="custom-input" value="DCTC-2026-">
                </div>
                <div class="form-row">
                    <label>Backup</label>
                    <button class="btn-action-outline" onclick="simulateDownload()">
                        <i class="fas fa-database"></i> Download Database Backup
                    </button>
                </div>
            </div>

            <div id="users" class="tab-panel">
                <div class="form-row">
                    <label>Staff Registry</label>
                    <input type="text" class="custom-input" placeholder="Search Staff by Name...">
                </div>
                <div class="form-row">
                    <label>Role</label>
                    <select class="custom-input">
                        <option>Super Admin</option>
                        <option>Registrar</option>
                        <option>Instructor</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>Management</label>
                    <button class="btn-action-outline"><i class="fas fa-user-plus"></i> Add New Staff Account</button>
                </div>
            </div>

            <div id="appearance" class="tab-panel">
                <div class="form-row">
                    <label>Theme</label>
                    <select class="custom-input" id="theme-selector" onchange="applyTheme(this.value)">
                        <option value="light">Light Mode (Default)</option>
                        <option value="dark">Dark Mode</option>
                    </select>
                </div>
            </div>

            <div class="settings-action-row">
                <button class="btn-dark-green" onclick="saveAllSettings()">Save All Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>function applyTheme(theme) {
    const body = document.getElementById("main-body");

    if (theme === "dark") {
        body.classList.add("dark-theme");
    } else {
        body.classList.remove("dark-theme");
    }

    // save theme
    localStorage.setItem("theme", theme);
}

// auto load on refresh
window.onload = function () {
    const savedTheme = localStorage.getItem("theme") || "light";

    applyTheme(savedTheme);

    const selector = document.getElementById("theme-selector");
    if (selector) {
        selector.value = savedTheme;
    }
};</script>
<script>
function openTab(evt, tabName) {
    document.querySelectorAll(".tab-panel").forEach(p => p.classList.remove("active"));
    document.querySelectorAll(".nav-tab").forEach(t => t.classList.remove("active"));
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
}
function simulateDownload() { alert("Preparing SQL Backup... Database downloaded successfully."); }
function saveAllSettings()  { alert("Settings for Dasmariñas City Training Center have been updated."); }
function applyTheme(val) { document.body.classList.toggle('dark-theme', val === 'dark'); }
</script>
@endsection