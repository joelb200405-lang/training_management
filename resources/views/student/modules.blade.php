@extends('student.layout')

@section('title', 'My Courses')

@section('css')
<style>
/* ── Container ─────────────────────────────────────────────── */
.courses-overview-wrap {
    padding: 32px 40px;
    font-family: 'Open Sans', system-ui, -apple-system, sans-serif;
}

.page-title {
    font-size: 24px;
    font-weight: 800;
    color: #025628;
    margin-bottom: 24px;
}

/* ── Grid Container ────────────────────────────────────────── */
.courses-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 28px;
}

/* ── Course Card ───────────────────────────────────────────── */
.course-card {
    width: 340px;
    border: 1px solid #E2E8F0;
    border-radius: 16px;
    overflow: hidden;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    transition: transform 0.2s, box-shadow 0.2s;
}

.course-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

.card-banner {
    background-color: #025628;
    height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    position: relative;
    padding: 16px;
}

.card-banner svg {
    width: 64px;
    height: 64px;
    fill: currentColor;
    opacity: 0.85;
}

.category-tag-overlay {
    position: absolute;
    top: 16px;
    left: 16px;
    background-color: #D4D120;
    color: #1A1A1A;
    font-size: 11px;
    font-weight: 800;
    padding: 5px 14px;
    border-radius: 20px;
    text-transform: capitalize;
}

.card-body {
    padding: 22px 20px 24px 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.course-card-title {
    font-size: 18px;
    font-weight: 800;
    color: #025628;
    margin-bottom: 8px;
    line-height: 1.35;
}

.course-card-desc {
    font-size: 13px;
    color: #4A5568;
    line-height: 1.5;
    margin-bottom: 20px;
}

.progress-bar-bg {
    width: 100%;
    height: 8px;
    background-color: #EDF2F7;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 8px;
}

.progress-bar-fill {
    height: 100%;
    background-color: #025628;
    border-radius: 10px;
}

.progress-text {
    font-size: 12px;
    font-weight: 700;
    color: #025628;
    margin-bottom: 20px;
}

.btn-start-course {
    width: 100%;
    background-color: #025628;
    color: #ffffff;
    border: none;
    padding: 12px 0;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.2s;
    margin-top: auto;
    display: block;
}

.btn-start-course:hover {
    background-color: #013d1c;
    color: #ffffff;
}

/* ── COURSE CONTENT & UNIT STYLES ───────────────────────── */
.course-detail-container {
    max-width: 900px;
    color: #2D3748;
}

.course-main-header {
    font-size: 26px;
    font-weight: 800;
    color: #025628;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 24px;
}

.course-top-banner {
    background-color: #025628;
    color: #ffffff;
    border-radius: 20px;
    padding: 24px 32px;
    margin-bottom: 28px;
}

.banner-meta-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 18px;
    flex-wrap: wrap;
    gap: 12px;
}

.banner-divider {
    color: rgba(255, 255, 255, 0.4);
}

.banner-progress-bar {
    width: 100%;
    height: 8px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 8px;
}

.banner-progress-fill {
    height: 100%;
    background-color: #ffffff;
    border-radius: 10px;
}

.banner-progress-text {
    text-align: right;
    font-size: 12px;
    font-weight: 700;
}

.welcome-title {
    font-size: 15px;
    font-weight: 700;
    color: #025628;
    font-style: italic;
    margin-bottom: 12px;
}

.welcome-desc {
    font-size: 13px;
    line-height: 1.6;
    color: #4A5568;
    margin-bottom: 24px;
}

.section-label {
    font-size: 13px;
    font-weight: 700;
    color: #2D3748;
    margin-top: 16px;
    margin-bottom: 10px;
}

.bullet-list {
    list-style: none;
    padding-left: 0;
    margin-bottom: 24px;
}

.bullet-list li {
    font-size: 12px;
    color: #4A5568;
    line-height: 1.6;
    margin-bottom: 4px;
    position: relative;
    padding-left: 16px;
}

.bullet-list li::before {
    content: "•";
    color: #4A5568;
    position: absolute;
    left: 0;
    font-weight: bold;
}

.content-hr {
    border: none;
    border-top: 1px solid #CBD5E0;
    margin: 28px 0;
}

.yellow-notice-box {
    background-color: #D4D120;
    color: #1A1A1A;
    border-radius: 16px;
    padding: 18px 24px;
    font-size: 12px;
    line-height: 1.5;
    font-weight: 600;
    margin-bottom: 28px;
}

.pretest-action-bar {
    background: #CBD5E0;
    border-radius: 12px;
    padding: 14px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.pretest-btn {
    background: transparent;
    border: none;
    font-size: 13px;
    font-weight: 700;
    color: #025628;
    cursor: pointer;
    padding: 0;
}

.pretest-score {
    font-size: 13px;
    font-weight: 700;
    color: #2D3748;
}

.btn-back-overview {
    background: transparent;
    border: 1px solid #025628;
    color: #025628;
    padding: 6px 16px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    margin-bottom: 20px;
}

.unit-title-header {
    font-size: 22px;
    font-weight: 800;
    color: #025628;
    margin-bottom: 16px;
}

.module-action-row {
    background: #CBD5E0;
    border-radius: 12px;
    padding: 14px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.module-action-title { font-size: 14px; font-weight: 700; color: #2D3748; }
.module-buttons-group { display: flex; gap: 12px; }

.btn-module-done {
    background: transparent;
    border: 1.5px solid #025628;
    color: #025628;
    padding: 6px 18px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-module-done.completed { background: #025628; color: #ffffff; }

.btn-module-view {
    background: transparent;
    border: 1.5px solid #025628;
    color: #025628;
    padding: 6px 24px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-module-view:hover { background: #025628; color: #ffffff; }

/* ── COMPLETION SCREEN STYLES ───────────────────────────── */
.mayor-message-card {
    border: 2px solid #025628;
    border-radius: 20px;
    padding: 28px;
    background: #ffffff;
    position: relative;
    overflow: hidden;
    margin-bottom: 32px;
    box-shadow: 0 4px 12px rgba(2, 86, 40, 0.08);
}

.mayor-seal-watermark {
    position: absolute;
    right: -20px;
    top: -20px;
    width: 280px;
    height: 280px;
    opacity: 0.12;
    pointer-events: none;
}

.mayor-card-title { font-size: 15px; font-weight: 800; color: #025628; margin-bottom: 2px; }
.mayor-card-sub { font-size: 11px; color: #718096; margin-bottom: 18px; }
.mayor-card-body { font-size: 12.5px; line-height: 1.65; color: #2D3748; }
.mayor-card-sign { margin-top: 18px; font-size: 12px; font-weight: 700; color: #025628; }

.evaluation-block-label { font-size: 13px; font-weight: 800; color: #025628; margin-bottom: 4px; }
.evaluation-block-desc { font-size: 11.5px; color: #718096; margin-bottom: 12px; }

/* Document Viewer Modal */
.doc-viewer-modal {
    display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.65); backdrop-filter: blur(4px); z-index: 10000;
    align-items: center; justify-content: center;
}

.doc-viewer-card {
    background: #ffffff; width: 92%; max-width: 780px; height: 85vh;
    border-radius: 20px; overflow: hidden; display: flex; flex-direction: column;
    box-shadow: 0 12px 36px rgba(0, 0, 0, 0.25);
}

.doc-viewer-header { background: #025628; color: #ffffff; padding: 18px 24px; display: flex; justify-content: space-between; align-items: center; }
.doc-viewer-title { font-size: 16px; font-weight: 800; }
.doc-viewer-sub { font-size: 11px; color: rgba(255, 255, 255, 0.8); }

.doc-viewer-close {
    background: rgba(255, 255, 255, 0.2); border: none; color: #ffffff;
    width: 32px; height: 32px; border-radius: 50%; cursor: pointer; font-size: 16px;
    display: flex; align-items: center; justify-content: center;
}

.doc-viewer-body { flex: 1; overflow-y: auto; padding: 32px; background: #F8FAFC; line-height: 1.7; color: #334155; font-size: 13px; }
.doc-page-sheet { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 12px; padding: 32px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); }
.doc-viewer-footer { padding: 16px 24px; border-top: 1px solid #E2E8F0; background: #ffffff; display: flex; justify-content: flex-end; align-items: center; }

@media (max-width: 640px) {
    .courses-overview-wrap { padding: 16px; }
    .course-card { width: 100%; }
}
</style>
@endsection

@section('content')
<div class="courses-overview-wrap">

    {{-- ── SCREEN 1: COURSE OVERVIEW GRID ──────────────────────── --}}
    <div id="courseOverviewScreen">
        <h1 class="page-title">Course Overview</h1>

        <div class="courses-grid">
            @forelse($enrollments as $e)
                @php
                    $isStreetFood = str_contains(strtolower($e->course->title ?? ''), 'street food') || str_contains(strtolower($e->course->title ?? ''), 'snack');
                @endphp
                <div class="course-card">
                    <div class="card-banner">
                        <span class="category-tag-overlay">
                            {{ $e->course->category ?? 'Livelihood' }}
                        </span>
                        <svg viewBox="0 0 24 24">
                            <path d="M19 2H6c-1.2 0-2 .8-2 2v16c0 1.2.8 2 2 2h13c1.1 0 2-.9 2-2V4c0-1.2-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4zm13 16H6c-.6 0-1-.4-1-1s.4-1 1-1h13v2zm0-3H6c-.2 0-.4 0-.6.1V14h13.6v3z"/>
                        </svg>
                    </div>

                    <div class="card-body">
                        <div class="course-card-title">
                            {{ $e->course->title ?? 'Street Food and Snacks' }}
                        </div>

                        <div class="course-card-desc">
                            {{ Str::limit($e->course->description ?? 'Master the art of preparing popular Filipino street food and snacks for business...', 90) }}
                        </div>

                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width: {{ $e->progress ?? 0 }}%;"></div>
                        </div>
                        <div class="progress-text">
                            {{ $e->progress ?? 0 }}% Complete
                        </div>

                        <button onclick="startCourse('{{ addslashes($e->course->title ?? 'Street Food and Snacks') }}', '{{ $e->progress ?? 0 }}', {{ $isStreetFood ? 'true' : 'false' }})" class="btn-start-course">
                            Start this Course
                        </button>
                    </div>
                </div>
            @empty
                <div class="course-card">
                    <div class="card-banner">
                        <span class="category-tag-overlay">Livelihood</span>
                        <svg viewBox="0 0 24 24">
                            <path d="M19 2H6c-1.2 0-2 .8-2 2v16c0 1.2.8 2 2 2h13c1.1 0 2-.9 2-2V4c0-1.2-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4zm13 16H6c-.6 0-1-.4-1-1s.4-1 1-1h13v2zm0-3H6c-.2 0-.4 0-.6.1V14h13.6v3z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <div class="course-card-title">Street Food and Snacks</div>
                        <div class="course-card-desc">
                            Master the art of preparing popular Filipino street food and snacks for business...
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width: 0%;"></div>
                        </div>
                        <div class="progress-text">0% Complete</div>
                        <button onclick="startCourse('Street Food and Snacks', '0', true)" class="btn-start-course">
                            Start this Course
                        </button>
                    </div>
                </div>

                <div class="course-card">
                    <div class="card-banner">
                        <span class="category-tag-overlay">Livelihood</span>
                        <svg viewBox="0 0 24 24">
                            <path d="M19 2H6c-1.2 0-2 .8-2 2v16c0 1.2.8 2 2 2h13c1.1 0 2-.9 2-2V4c0-1.2-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4zm13 16H6c-.6 0-1-.4-1-1s.4-1 1-1h13v2zm0-3H6c-.2 0-.4 0-.6.1V14h13.6v3z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <div class="course-card-title">Computer Literacy</div>
                        <div class="course-card-desc">
                            Basic computer skills including MS Office, internet browsing, and email communic...
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width: 0%;"></div>
                        </div>
                        <div class="progress-text">0% Complete</div>
                        <button onclick="startCourse('Computer Literacy', '0', false)" class="btn-start-course">
                            Start this Course
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ── SCREEN 2: COURSE CONTENT INTRO / OVERVIEW ────────── --}}
    <div id="courseContentScreen" style="display: none;">
        
        <button onclick="backToOverview()" class="btn-back-overview">
            ← Back to Overview
        </button>

        <div class="course-detail-container">
            <h1 class="course-main-header" id="activeCourseTitle">
                STREET FOOD AND SNACKS
            </h1>

            <div class="course-top-banner">
                <div class="banner-meta-row">
                    <span id="courseMetaDuration">Duration: 5 Days</span>
                    <span class="banner-divider">|</span>
                    <span id="courseMetaPace">Pace: Mon-Tue 10:00 AM</span>
                    <span class="banner-divider">|</span>
                    <span>Self-Paced + Hands-On Cooking</span>
                </div>
                <div class="banner-progress-bar">
                    <div class="banner-progress-fill" id="activeCourseProgressFill" style="width: 0%"></div>
                </div>
                <div class="banner-progress-text" id="activeCourseProgressText">
                    0% Complete
                </div>
            </div>

            <div id="courseBodyContent"></div>

            <div class="pretest-action-bar">
                <button onclick="takePretestAction()" class="pretest-btn" id="introPretestBtn">
                    Take Pre-Test
                </button>
                <span class="pretest-score" id="introPretestScore">- / 10</span>
            </div>
        </div>
    </div>

    {{-- ── SCREEN 3: UNIT 1 VIEW ────────────────────────────── --}}
    <div id="unit1Screen" style="display: none;">
        
        <button onclick="showIntroScreen()" class="btn-back-overview">
            ← Back to Introduction
        </button>

        <div class="course-detail-container">
            <h1 class="course-main-header" id="unitPageCourseTitle">
                STREET FOOD AND SNACKS
            </h1>

            <div class="course-top-banner">
                <div class="banner-meta-row" style="margin-bottom:12px;">
                    <span id="unitBannerDuration">Total Unit Duration: Day 2 (1 Day | ~2 Hours)</span>
                </div>
                <div class="banner-progress-bar">
                    <div class="banner-progress-fill" style="width: 0%"></div>
                </div>
                <div class="banner-progress-text">
                    0% Complete
                </div>
            </div>

            <h2 class="unit-title-header" id="unitPageHeaderTitle">
                UNIT 1: Fried Snacks & Signature Dipping Sauces
            </h2>

            <div class="section-label" style="font-weight:600; color:#4A5568;">Learning Objectives:</div>
            <p style="font-size:12px; color:#4A5568; margin-bottom:8px;">By the end of this Unit, you will be able to:</p>
            <ol style="font-size:12px; color:#4A5568; padding-left:18px; line-height:1.7; margin-bottom:24px;" id="unitObjectivesList">
                <li>Demonstrate proper kitchen sanitation and food safety principles.</li>
                <li>Prepare authentic batters for fishballs, kwek-kwek, and kikiam.</li>
                <li>Master commercial sauce-making techniques (Sweet, Spicy, and Vinegar dip).</li>
            </ol>

            <hr class="content-hr">

            <div class="yellow-notice-box">
                Notice:<br>
                Every module includes a practical hands-on task. You can practice directly at your assigned Barangay Hall or EDIPO Main Culinary Lab station.
            </div>

            <div class="module-action-row">
                <div class="module-action-title">Module 1</div>
                <div class="module-buttons-group">
                    <button onclick="toggleMarkDone(this, 1)" class="btn-module-done" id="mod1DoneBtn">Mark as Done</button>
                    <button onclick="triggerDocView('Module 1', 1)" class="btn-module-view">View</button>
                </div>
            </div>

            <div class="module-action-row">
                <div class="module-action-title">Module 2</div>
                <div class="module-buttons-group">
                    <button onclick="toggleMarkDone(this, 2)" class="btn-module-done" id="mod2DoneBtn">Mark as Done</button>
                    <button onclick="triggerDocView('Module 2', 1)" class="btn-module-view">View</button>
                </div>
            </div>

        </div>
    </div>

    {{-- ── SCREEN 4: UNIT 2 VIEW ────────────────────────────── --}}
    <div id="unit2Screen" style="display: none;">
        
        <button onclick="showIntroScreen()" class="btn-back-overview">
            ← Back to Introduction
        </button>

        <div class="course-detail-container">
            <h1 class="course-main-header" id="unit2PageCourseTitle">
                STREET FOOD AND SNACKS
            </h1>

            <div class="course-top-banner">
                <div class="banner-meta-row" style="margin-bottom:12px;">
                    <span id="unit2BannerDuration">Total Unit Duration: Day 3 (1 Day | ~2 Hours)</span>
                </div>
                <div class="banner-progress-bar">
                    <div class="banner-progress-fill" style="width: 0%"></div>
                </div>
                <div class="banner-progress-text">
                    0% Complete
                </div>
            </div>

            <h2 class="unit-title-header" id="unit2PageHeaderTitle">
                UNIT 2: Sweet Delicacies, Refreshments & Costing
            </h2>

            <div class="section-label" style="font-weight:600; color:#4A5568;">Learning Objectives:</div>
            <p style="font-size:12px; color:#4A5568; margin-bottom:8px;">By the end of this Unit, you will be able to:</p>
            <ol style="font-size:12px; color:#4A5568; padding-left:18px; line-height:1.7; margin-bottom:24px;" id="unit2ObjectivesList">
                <li>Prepare popular sweet street snacks (Banana cue, Turon, and Samalamig drinks).</li>
                <li>Implement proper portion control and ingredient preservation.</li>
                <li>Compute vendor profit margins and product pricing strategies.</li>
            </ol>

            <hr class="content-hr">

            <div class="yellow-notice-box">
                Notice:<br>
                Every module includes a practical hands-on task. You can practice directly at your assigned Barangay Hall or EDIPO Main Culinary Lab station.
            </div>

            <div class="module-action-row">
                <div class="module-action-title">Module 1</div>
                <div class="module-buttons-group">
                    <button onclick="toggleMarkDone(this, 3)" class="btn-module-done">Mark as Done</button>
                    <button onclick="triggerDocView('Module 1', 2)" class="btn-module-view">View</button>
                </div>
            </div>

            <div class="module-action-row">
                <div class="module-action-title">Module 2</div>
                <div class="module-buttons-group">
                    <button onclick="toggleMarkDone(this, 4)" class="btn-module-done">Mark as Done</button>
                    <button onclick="triggerDocView('Module 2', 2)" class="btn-module-view">View</button>
                </div>
            </div>

        </div>
    </div>

    {{-- ── SCREEN 5: COMPLETION VIEW ────────────────────────── --}}
    <div id="completionScreen" style="display: none;">
        
        <button onclick="showIntroScreen()" class="btn-back-overview">
            ← Back to Introduction
        </button>

        <div class="course-detail-container">
            <h1 class="course-main-header" id="completionCourseTitle">
                COMPUTER LITERACY
            </h1>

            <div class="course-top-banner">
                <div class="banner-meta-row" style="margin-bottom:12px;">
                    <span>Total Unit Duration: Days 5–8 (4 Days | ~30 Mins/Day)</span>
                </div>
                <div class="banner-progress-bar">
                    <div class="banner-progress-fill" style="width: 0%"></div>
                </div>
                <div class="banner-progress-text" id="completionProgressPercent">
                    0% Complete
                </div>
            </div>

            <h3 style="font-size:16px; font-weight:800; color:#025628; margin-bottom:4px; font-style:italic;">
                CONGRATULATIONS! YOU HAVE REACHED THE END OF THE MODULES.
            </h3>
            <p style="font-size:12px; color:#4A5568; margin-bottom:24px;">
                You are just one step away from completing the Program.
            </p>

            <hr class="content-hr">

            <div class="mayor-message-card">
                <svg class="mayor-seal-watermark" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#025628" stroke-width="4"/>
                    <text x="50" y="55" font-size="12" text-anchor="middle" fill="#025628" font-weight="bold">CITY OF DASMARIÑAS</text>
                </svg>

                <div class="mayor-card-title">A Special Message from Mayor Jenny Barzaga</div>
                <div class="mayor-card-sub">City Mayor of Dasmariñas, Cavite</div>

                <div class="mayor-card-body">
                    <strong>Mabuhay at Maligayang Bati!</strong><br>
                    "Congratulations on reaching the final stage of our Training Program!<br>
                    As Mayor of Dasmariñas, I am immensely proud of your dedication to learning new skills. Technology and livelihood training are powerful tools, opening up new opportunities for personal growth, employment, and community development.<br>
                    The City Government of Dasmariñas, through our Local Economic Development and Investment Promotion Office (LEDIPO), remains fully committed to supporting programs that empower our citizens.<br>
                    Keep moving forward, stay curious, and continue building a brighter future for yourself and for Dasma!"
                </div>

                <div class="mayor-card-sign">
                    — Hon. Jennifer "Jenny" Austria-Barzaga<br>
                    <span style="font-size:10px; font-weight:normal; color:#718096;">City Mayor, Dasmariñas, Cavite</span>
                </div>
            </div>

            <hr class="content-hr">

            {{-- Post Test Row --}}
            <div class="evaluation-block-label">Complete your final evaluations to finish the program</div>
            <div class="evaluation-block-desc">Take the 80-question final written test. You need a score of 80% or higher.</div>

            <div class="pretest-action-bar">
                <button onclick="openPosttestSidebarModal()" class="pretest-btn" id="completionPosttestBtn">
                    Take Post-Test
                </button>
                <span class="pretest-score" id="completionPosttestScore">- / 80</span>
            </div>

            {{-- Hands On Practical Test Row --}}
            <div class="evaluation-block-label">Complete the Final Hands-On Test</div>
            <div class="evaluation-block-desc">
                Demonstrate what you learned! Perform a practical task evaluated by your lab instructor at your assigned venue.<br>
                <i>(Note: Exact session dates/times will be announced by your Barangay / LEDIPO coordinator).</i>
            </div>

            <div class="pretest-action-bar">
                <span style="font-size:13px; font-weight:700; color:#718096;">Practical Test</span>
                <span class="pretest-score">- / 100</span>
            </div>

            <hr class="content-hr">

            {{-- Certificate Download Row --}}
            <div class="evaluation-block-label">Download & Claim Your Official Certificate</div>
            <div class="evaluation-block-desc">
                Congratulations! You completed all lessons, hands-on tasks, written post-test, and practical evaluation.
            </div>

            <div class="pretest-action-bar">
                <button onclick="openCertificateModal()" class="pretest-btn" id="completionCertBtn">
                    Certificate of Completion
                </button>
                <button onclick="openCertificateModal()" style="background:transparent; border:none; color:#025628; font-weight:700; font-size:12px; cursor:pointer;">
                    View / Download
                </button>
            </div>

            <div class="yellow-notice-box" style="margin-top:20px;">
                <strong>Download Prerequisite Notice:</strong><br>
                Your Digital E-Certificate is downloadable below.
            </div>

        </div>
    </div>

</div>

{{-- ── DOCUMENT VIEWER POPUP MODAL ────────────────────────── --}}
<div id="docViewerModal" class="doc-viewer-modal">
    <div class="doc-viewer-card">
        <div class="doc-viewer-header">
            <div>
                <div class="doc-viewer-title" id="docViewerName">Module 1</div>
                <div class="doc-viewer-sub" id="docViewerSub">Street Food Hygiene & Prep</div>
            </div>
            <button onclick="closeDocViewer()" class="doc-viewer-close">✕</button>
        </div>

        <div class="doc-viewer-body">
            <div class="doc-page-sheet" id="docSheetContent"></div>
        </div>

        <div class="doc-viewer-footer">
            <button onclick="alert('Downloading lesson guide PDF...');" style="background:#025628; color:#fff; border:none; padding:9px 22px; border-radius:10px; font-weight:700; font-size:12px; cursor:pointer;">
                Download PDF
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let _currentIsStreetFood = true;

/* ── TRACKING PROGRESS STATE (ALL 4 MODULES + PRE/POST TESTS) ── */
let _hasTakenPretest  = false;
let _completedModules = { 1: false, 2: false, 3: false, 4: false };
let _hasTakenPosttest = false;

/* ── DYNAMIC PROGRESS BAR CALCULATOR ── */
function updateCourseProgress() {
    let completedCount = 0;
    const totalTasks = 6; // Pre-test (1) + 4 Modules (4) + Post-test (1) = 6 Total Tasks

    if (_hasTakenPretest) completedCount++;
    
    Object.values(_completedModules).forEach(isDone => {
        if (isDone) completedCount++;
    });

    if (_hasTakenPosttest) completedCount++;

    let currentPercentage = Math.round((completedCount / totalTasks) * 100);

    const fillElements = [
        document.getElementById('activeCourseProgressFill'),
        document.querySelectorAll('#unit1Screen .banner-progress-fill')[0],
        document.querySelectorAll('#unit2Screen .banner-progress-fill')[0],
        document.querySelectorAll('#completionScreen .banner-progress-fill')[0]
    ];

    fillElements.forEach(el => {
        if (el) el.style.width = currentPercentage + '%';
    });

    const textElements = [
        document.getElementById('activeCourseProgressText'),
        document.querySelectorAll('#unit1Screen .banner-progress-text')[0],
        document.querySelectorAll('#unit2Screen .banner-progress-text')[0],
        document.querySelectorAll('#completionScreen .banner-progress-text')[0]
    ];

    textElements.forEach(el => {
        if (el) el.textContent = currentPercentage + '% Complete';
    });
}

function startCourse(title, progress, isStreetFood) {
    _currentIsStreetFood = isStreetFood;

    document.getElementById('courseOverviewScreen').style.display = 'none';
    document.getElementById('courseContentScreen').style.display  = 'block';
    document.getElementById('unit1Screen').style.display          = 'none';
    document.getElementById('unit2Screen').style.display          = 'none';
    document.getElementById('completionScreen').style.display     = 'none';

    const sidebarIndex = document.getElementById('sidebarIndexMenu');
    if (sidebarIndex) { sidebarIndex.style.display = 'block'; }

    document.getElementById('activeCourseTitle').textContent = title.toUpperCase();
    document.getElementById('unitPageCourseTitle').textContent = title.toUpperCase();
    document.getElementById('unit2PageCourseTitle').textContent = title.toUpperCase();
    document.getElementById('completionCourseTitle').textContent = title.toUpperCase();

    const certName = document.getElementById('certProgramName');
    if (certName) { certName.textContent = title; }

    const bodyContainer = document.getElementById('courseBodyContent');

    if (isStreetFood) {
        document.getElementById('courseMetaDuration').textContent = 'Duration: 5 Days';
        document.getElementById('courseMetaPace').textContent     = 'Pace: Mon-Tue 10:00 AM';

        bodyContainer.innerHTML = `
            <div class="welcome-title">Welcome to Street Food and Snacks Preparation!</div>
            <p class="welcome-desc">Master the art of preparing popular Filipino street foods and snacks for personal enjoyment or commercial business operations. Learn proper food safety, hygiene, cost-effective preparation techniques, and authentic recipes.</p>
            <div class="section-label">Course Objectives:</div>
            <ul class="bullet-list">
                <li>Understand food safety, sanitation, and clean preparation standards.</li>
                <li>Learn proper batter preparation, deep-frying techniques, and sauce crafting.</li>
                <li>Master recipes for popular street snacks (kwek-kwek, fishballs, kikiam, banana cue, turon, and gulaman).</li>
                <li>Calculate ingredient costing, pricing strategies, and street food vendor business management.</li>
            </ul>
            <hr class="content-hr">
            <div class="section-label">5-Day Culinary Roadmap:</div>
            <ul class="bullet-list">
                <li><strong>Day 1:</strong> Kitchen Orientation, Food Hygiene, & Baseline Culinary Pre-test</li>
                <li><strong>Day 2 (Unit 1):</strong> Fried Snacks & Signature Dipping Sauces (Duration: 1 Day)</li>
                <li><strong>Day 3 (Unit 2):</strong> Sweet Snacks, Native Delicacies & Refreshment Drinks (Duration: 1 Day)</li>
                <li><strong>Days 4–5:</strong> Practical Cooking Assessment, Costing Analysis, & Certificate Awarding</li>
            </ul>
            <div class="yellow-notice-box">
                Notice:<br>
                Every module includes a practical hands-on cooking task. Ingredients and cooking stations are provided directly at your assigned Barangay Hall or EDIPO Main Culinary Lab.
            </div>
        `;
    } else {
        document.getElementById('courseMetaDuration').textContent = 'Duration: 10 Days';
        document.getElementById('courseMetaPace').textContent     = 'Pace: 30–45 Mins/Day';

        bodyContainer.innerHTML = `
            <div class="welcome-title">Welcome to Basic Computer Literacy!</div>
            <p class="welcome-desc">Welcome to your step-by-step journey into mastering everyday computer skills. Whether you want to learn the basics of hardware, navigate an operating system, or safely browse the internet, this course will build your confidence hands-on.</p>
            <div class="section-label">Course Objectives:</div>
            <ul class="bullet-list">
                <li>Master basic mouse clicking, scrolling, and keyboard typing.</li>
                <li>Learn how to turn on/off a PC and open daily applications.</li>
                <li>Create, save, and organize simple documents and folders.</li>
                <li>Browse the internet safely and search for information.</li>
            </ul>
            <hr class="content-hr">
            <div class="section-label">10-Day Roadmap:</div>
            <ul class="bullet-list">
                <li><strong>Day 1:</strong> Course Welcome, Venue Choice, & Baseline Pre-test</li>
                <li><strong>Days 2–4 (Unit 1):</strong> Mouse, Keyboard, & Computer Basics (Duration: 3 Days)</li>
                <li><strong>Days 5–8 (Unit 2):</strong> Working with Files & Simple Web Browsing (Duration: 4 Days)</li>
                <li><strong>Days 9–10:</strong> Final Practice, Post-test, & Getting Your Certificate (Duration: 2 Days)</li>
            </ul>
            <div class="yellow-notice-box">
                Notice:<br>
                Every module includes a practical hands-on task. You can practice directly on the computers at your assigned Barangay Hall or EDIPO main lab.
            </div>
        `;
    }

    updateCourseProgress();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showUnit1Screen() {
    document.getElementById('courseOverviewScreen').style.display = 'none';
    document.getElementById('courseContentScreen').style.display  = 'none';
    document.getElementById('unit1Screen').style.display          = 'block';
    document.getElementById('unit2Screen').style.display          = 'none';
    document.getElementById('completionScreen').style.display     = 'none';

    if (_currentIsStreetFood) {
        document.getElementById('unitPageHeaderTitle').textContent = 'UNIT 1: Fried Snacks & Signature Dipping Sauces';
        document.getElementById('unitBannerDuration').textContent    = 'Total Unit Duration: Day 2 (1 Day | ~2 Hours)';
        document.getElementById('unitObjectivesList').innerHTML       = `
            <li>Demonstrate proper kitchen sanitation and food safety principles.</li>
            <li>Prepare authentic batters for fishballs, kwek-kwek, and kikiam.</li>
            <li>Master commercial sauce-making techniques (Sweet, Spicy, and Vinegar dip).</li>
        `;
    } else {
        document.getElementById('unitPageHeaderTitle').textContent = 'UNIT 1: Computer Basics, Mouse & Keyboard';
        document.getElementById('unitBannerDuration').textContent    = 'Total Unit Duration: Days 2–4 (3 Days | ~30 Mins/Day)';
        document.getElementById('unitObjectivesList').innerHTML       = `
            <li>Identify the 4 main physical components of a desktop computer.</li>
            <li>Safely turn on and shut down a desktop computer.</li>
            <li>Perform left-click, right-click, double-click, and typing tasks independently.</li>
        `;
    }

    updateCourseProgress();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showUnit2Screen() {
    document.getElementById('courseOverviewScreen').style.display = 'none';
    document.getElementById('courseContentScreen').style.display  = 'none';
    document.getElementById('unit1Screen').style.display          = 'none';
    document.getElementById('unit2Screen').style.display          = 'block';
    document.getElementById('completionScreen').style.display     = 'none';

    if (_currentIsStreetFood) {
        document.getElementById('unit2PageHeaderTitle').textContent = 'UNIT 2: Sweet Delicacies, Refreshments & Costing';
        document.getElementById('unit2BannerDuration').textContent    = 'Total Unit Duration: Day 3 (1 Day | ~2 Hours)';
        document.getElementById('unit2ObjectivesList').innerHTML       = `
            <li>Prepare popular sweet street snacks (Banana cue, Turon, and Samalamig drinks).</li>
            <li>Implement proper portion control and ingredient preservation.</li>
            <li>Compute vendor profit margins and product pricing strategies.</li>
        `;
    } else {
        document.getElementById('unit2PageHeaderTitle').textContent = 'UNIT 2: Files, Folders & Safe Web Browsing';
        document.getElementById('unit2BannerDuration').textContent    = 'Total Unit Duration: Days 5–8 (4 Days | ~30 Mins/Day)';
        document.getElementById('unit2ObjectivesList').innerHTML       = `
            <li>Create, rename, move, and organize files inside desktop folders.</li>
            <li>Open a web browser and search for information safely online.</li>
            <li>Understand basic password safety and online security principles.</li>
        `;
    }

    updateCourseProgress();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showCompletionScreen() {
    document.getElementById('courseOverviewScreen').style.display = 'none';
    document.getElementById('courseContentScreen').style.display  = 'none';
    document.getElementById('unit1Screen').style.display          = 'none';
    document.getElementById('unit2Screen').style.display          = 'none';
    document.getElementById('completionScreen').style.display     = 'block';

    updateCourseProgress();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showIntroScreen() {
    document.getElementById('courseOverviewScreen').style.display = 'none';
    document.getElementById('courseContentScreen').style.display  = 'block';
    document.getElementById('unit1Screen').style.display          = 'none';
    document.getElementById('unit2Screen').style.display          = 'none';
    document.getElementById('completionScreen').style.display     = 'none';

    updateCourseProgress();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function backToOverview() {
    document.getElementById('courseOverviewScreen').style.display = 'block';
    document.getElementById('courseContentScreen').style.display  = 'none';
    document.getElementById('unit1Screen').style.display          = 'none';
    document.getElementById('unit2Screen').style.display          = 'none';
    document.getElementById('completionScreen').style.display     = 'none';

    const sidebarIndex = document.getElementById('sidebarIndexMenu');
    if (sidebarIndex) { sidebarIndex.style.display = 'none'; }
}

/* ── PRE-TEST CLICK ACTION ── */
function takePretestAction() {
    openPretestSidebarModal();
}

function triggerStartPretest() {
    closePretestSidebarModal();
    _hasTakenPretest = true;
    
    document.getElementById('introPretestBtn').textContent = 'Pre-Test Opened ✓';
    updateCourseProgress();

    if (typeof openQuizModal === 'function') {
        openQuizModal(1, 'Baseline Pre-test');
    }
}

/* ── MARK MODULE AS DONE ACTION ── */
function toggleMarkDone(btn, moduleNumber) {
    btn.classList.toggle('completed');
    
    if (btn.classList.contains('completed')) {
        btn.textContent = '✓ Done';
        _completedModules[moduleNumber] = true;
    } else {
        btn.textContent = 'Mark as Done';
        _completedModules[moduleNumber] = false;
    }
    
    updateCourseProgress();
}

/* ── TRIGGER POST TEST ── */
function triggerStartPosttest() {
    closePosttestSidebarModal();
    _hasTakenPosttest = true;
    
    document.getElementById('completionPosttestBtn').textContent = 'Post-Test Opened ✓';
    updateCourseProgress();

    if (typeof openQuizModal === 'function') {
        openQuizModal(2, 'Final Post-Test (80 Items)');
    }
}

/* ── DOCUMENT VIEWER HANDLER ── */
function triggerDocView(moduleName, unitNum = 1) {
    if (_currentIsStreetFood) {
        if (unitNum === 1) {
            if (moduleName === 'Module 1') {
                openDocViewer('Module 1', 'Street Food Hygiene, Sanitation & Batter Prep');
            } else {
                openDocViewer('Module 2', 'Signature Sauces, Deep-Frying & Temperature Control');
            }
        } else {
            if (moduleName === 'Module 1') {
                openDocViewer('Module 1', 'Sweet Delicacies: Turon & Banana Cue Preparation');
            } else {
                openDocViewer('Module 2', 'Refreshment Beverages & Vendor Costing Analysis');
            }
        }
    } else {
        if (unitNum === 1) {
            if (moduleName === 'Module 1') {
                openDocViewer('Module 1', 'Unit 1: Computer Basics & Hardware Orientation');
            } else {
                openDocViewer('Module 2', 'Unit 1: Mouse Actions & Keyboard Typing Techniques');
            }
        } else {
            if (moduleName === 'Module 1') {
                openDocViewer('Module 1', 'Unit 2: File Management & Folder Operations');
            } else {
                openDocViewer('Module 2', 'Unit 2: Safe Internet Browsing Fundamentals');
            }
        }
    }
}

function openDocViewer(moduleName, subTitle) {
    document.getElementById('docViewerName').textContent = moduleName;
    document.getElementById('docViewerSub').textContent  = subTitle;
    
    const sheetContent = document.getElementById('docSheetContent');

    if (_currentIsStreetFood) {
        if (moduleName === 'Module 1') {
            sheetContent.innerHTML = `
                <h3 style="color:#025628; font-weight:800; font-size:18px; margin-bottom:12px;">Street Food Hygiene, Sanitation & Batter Prep</h3>
                <p style="color:#64748B; font-size:11px; margin-bottom:20px;">Reading Time: 10 Mins | Material Type: Culinary Recipe & Safety Guide PDF</p>
                <h4 style="font-size:14px; font-weight:700; color:#1E293B; margin-top:16px;">1. Food Safety & Vendor Hygiene</h4>
                <p>Maintaining a clean prep station prevents foodborne illness and builds customer trust in commercial food operations.</p>
                <ul>
                    <li><strong>Hairnet & Apron:</strong> Always wear clean protective gear before touching ingredients.</li>
                    <li><strong>Handwashing:</strong> Wash hands with soap for at least 20 seconds before food prep.</li>
                    <li><strong>Cross-Contamination:</strong> Keep raw meats separate from pre-cooked batters and dipping sauces.</li>
                </ul>
                <h4 style="font-size:14px; font-weight:700; color:#1E293B; margin-top:20px;">2. Batter Ratios for Kwek-Kwek & Fishballs</h4>
                <p>Mastering batter consistency ensures crispiness and proper coating retention during frying:</p>
                <ol>
                    <li>Sift 2 cups of All-Purpose Flour and 1/2 cup of Cornstarch into a mixing bowl.</li>
                    <li>Add 1 teaspoon of annatto powder (atsuete) dissolved in 1.5 cups of cold water for color.</li>
                    <li>Whisk until smooth without flour lumps before coating boiled quail eggs or fishballs.</li>
                </ol>
            `;
        } else {
            sheetContent.innerHTML = `
                <h3 style="color:#025628; font-weight:800; font-size:18px; margin-bottom:12px;">Signature Dipping Sauces & Oil Temperature</h3>
                <p style="color:#64748B; font-size:11px; margin-bottom:20px;">Reading Time: 12 Mins | Material Type: Culinary Recipe & Sauce Guide PDF</p>
                <h4 style="font-size:14px; font-weight:700; color:#1E293B; margin-top:16px;">1. Classic Sweet & Spicy Brown Sauce</h4>
                <p>The dipping sauce is key to street food profitability and customer loyalty.</p>
                <ul>
                    <li><strong>Base Formula:</strong> Combine 3 cups water, 1/2 cup brown sugar, 2 tbsp soy sauce, and 2 tbsp cornstarch slurry.</li>
                    <li><strong>Aromatics:</strong> Add minced garlic, shallots, and chopped labuyo peppers to taste.</li>
                </ul>
            `;
        }
    } else {
        if (moduleName === 'Module 1') {
            sheetContent.innerHTML = `
                <h3 style="color:#025628; font-weight:800; font-size:18px; margin-bottom:12px;">Hardware Components & Computer Basics</h3>
                <p style="color:#64748B; font-size:11px; margin-bottom:20px;">Reading Time: 8 Mins | Material Type: Learning Guide PDF Document</p>
                <h4 style="font-size:14px; font-weight:700; color:#1E293B; margin-top:16px;">1. Introduction to the Desktop PC</h4>
                <p>A desktop computer consists of multiple physical parts connected together.</p>
                <ul>
                    <li><strong>System Unit (CPU Tower):</strong> Houses power controls and CPU.</li>
                    <li><strong>Monitor:</strong> Displays visual interface.</li>
                    <li><strong>Keyboard & Mouse:</strong> Input controls.</li>
                </ul>
            `;
        } else {
            sheetContent.innerHTML = `
                <h3 style="color:#025628; font-weight:800; font-size:18px; margin-bottom:12px;">Mouse Navigation & Keyboard Fundamentals</h3>
                <p style="color:#64748B; font-size:11px; margin-bottom:20px;">Reading Time: 10 Mins | Material Type: Practical Exercise PDF</p>
            `;
        }
    }

    document.getElementById('docViewerModal').style.display = 'flex';
}

function closeDocViewer() {
    document.getElementById('docViewerModal').style.display = 'none';
}
</script>
@endsection