<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEDIPO Trainer Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/settings.css">
</head>
<body>

    <div class="top-strip">
        <div class="language-selector">
            English <i class="fas fa-chevron-down"></i>
        </div>
    </div>

    <div class="container">
        
        <nav class="sidebar">
            <div class="logo">
                <img src="images/logo.png" alt="logo">
                <p class="sidebar-title">Dasmariñas City Training Center</p>
            </div>
            <ul>
                <li><a href="teacher"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="courses"><i class="fas fa-book"></i> Courses</a></li>
                <li><a href="learner"><i class="fas fa-users"></i> Trainees</a></li>
                <li><a href="assessment"><i class="fas fa-clipboard-check"></i> Assessment</a></li>
                <li><a href="certificates"><i class="fas fa-certificate"></i> Certificates</a></li>
                <li><a href="reports"><i class="fas fa-chart-line"></i> Reports</a></li>
                <li class="settings"><a href=" "><i class="fas fa-gear"></i> Settings</a></li>
            </ul>
        </nav>

        <main class="main-content">
            
            <header class="main-header">
                <div class="search-box">
                    <input type="text" placeholder="What are you looking for?">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                
                <div class="icon-buttons">
                    <div class="icon-item"><i class="fas fa-bell"></i></div>
                    <div class="icon-item logout"><i class="fas fa-right-from-bracket"></i></div>
                </div>
            </header>

            <div class="panel-padding">
                <div class="settings-card-frame">
                    
                    <nav class="settings-sidebar">
                        <button class="nav-tab active" onclick="openTab(event, 'account')">
                            <i class="fas fa-user"></i> Profile & Account
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
                                <select class="custom-input" id="theme-selector">
                                    <option value="light">Light Mode (Default)</option>
                                    <option value="dark">Dark Mode</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <label>Text Size</label>
                                <input type="range" min="12" max="22" value="14" class="custom-slider" id="fontSlider">
                            </div>
                        </div>

                        <div class="settings-action-row">
                            <button class="btn-dark-green" onclick="saveAllSettings()">Save All Changes</button>
                        </div>
                    </div> </div> </div> </main>
    </div>

    <script>
        /**
         * TAB NAVIGATION LOGIC
         * Switches visibility between different setting panels
         */
        function openTab(evt, tabName) {
            let i, tabpanels, tablinks;

            tabpanels = document.getElementsByClassName("tab-panel");
            for (i = 0; i < tabpanels.length; i++) {
                tabpanels[i].classList.remove("active");
            }

            tablinks = document.getElementsByClassName("nav-tab");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }

            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }

        /**
         * APPEARANCE LOGIC
         * Live font-size adjustment and theme feedback
         */
        const fontSlider = document.getElementById('fontSlider');
        if(fontSlider) {
            fontSlider.addEventListener('input', function() {
                document.querySelectorAll('.form-row label').forEach(label => {
                    label.style.fontSize = this.value + 'px';
                });
            });
        }

        function simulateDownload() {
            alert("Preparing SQL Backup... Database downloaded successfully.");
        }

        function saveAllSettings() {
            alert("Settings for Dasmariñas City Training Center have been updated.");
        }
    </script>

</body>
</html>