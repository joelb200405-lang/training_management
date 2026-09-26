@extends('student.layout')

@section('title', 'Announcements')

@section('css')
<style>
/* ── Main Container ────────────────────────────────────────── */
.announcements-wrap {
    padding: 32px 40px;
    font-family: 'Open Sans', system-ui, -apple-system, sans-serif;
    max-width: 1000px;
}

.page-header-title {
    font-size: 24px;
    font-weight: 800;
    color: #025628;
    margin-bottom: 6px;
}

.page-header-sub {
    font-size: 13px;
    color: #718096;
    margin-bottom: 28px;
}

/* ── Filter / Search Bar ───────────────────────────────────── */
.announcement-filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.search-box-wrap {
    position: relative;
    flex: 1;
    min-width: 260px;
}

.search-box-wrap input {
    width: 100%;
    padding: 10px 16px 10px 38px;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    font-size: 13px;
    outline: none;
    transition: border-color 0.2s;
}

.search-box-wrap input:focus {
    border-color: #025628;
}

.search-box-wrap i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #A0AEC0;
    font-size: 14px;
}

.filter-pills {
    display: flex;
    gap: 8px;
}

.filter-pill {
    background: #EDF2F7;
    color: #4A5568;
    border: none;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
}

.filter-pill.active, .filter-pill:hover {
    background: #025628;
    color: #ffffff;
}

/* ── Announcement Cards Stack ──────────────────────────────── */
.announcements-feed {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.announcement-card {
    background: #ffffff;
    border: 1px solid #E2E8F0;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    overflow: hidden;
}

.announcement-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
}

.announcement-card.pinned {
    border-left: 5px solid #D4D120;
}

.pin-badge {
    position: absolute;
    top: 16px;
    right: 20px;
    background: #FFFDF0;
    border: 1px solid #E2E07B;
    color: #1A1A1A;
    font-size: 10px;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.author-meta-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}

.author-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #025628;
    color: #ffffff;
    font-weight: 800;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.author-info .name {
    font-size: 13.5px;
    font-weight: 700;
    color: #1A202C;
}

.author-info .role-time {
    font-size: 11px;
    color: #718096;
}

.category-badge {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 3px 10px;
    border-radius: 10px;
    margin-bottom: 8px;
}

.badge-urgent { background: #FED7D7; color: #9B2C2C; }
.badge-general { background: #E2E8F0; color: #2D3748; }
.badge-schedule { background: #C6F6D5; color: #22543D; }

.announcement-title {
    font-size: 17px;
    font-weight: 800;
    color: #025628;
    margin-bottom: 10px;
    line-height: 1.35;
}

.announcement-body {
    font-size: 13px;
    color: #4A5568;
    line-height: 1.65;
    margin-bottom: 16px;
}

/* Optional Event Box inside Announcement */
.event-info-box {
    background: #F7FAFC;
    border: 1px solid #EDF2F7;
    border-radius: 12px;
    padding: 14px 18px;
    display: flex;
    gap: 20px;
    font-size: 12px;
    color: #2D3748;
    margin-bottom: 16px;
    flex-wrap: wrap;
}

.event-info-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
}

.event-info-item i {
    color: #025628;
}

.announcement-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid #EDF2F7;
    padding-top: 14px;
    font-size: 12px;
    color: #718096;
}

.footer-actions {
    display: flex;
    gap: 16px;
}

.action-btn {
    background: transparent;
    border: none;
    color: #718096;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s;
}

.action-btn:hover {
    color: #025628;
}

@media (max-width: 640px) {
    .announcements-wrap { padding: 20px 16px; }
    .announcement-filter-bar { flex-direction: column; align-items: stretch; }
    .filter-pills { overflow-x: auto; padding-bottom: 4px; }
}
</style>
@endsection

@section('content')
<div class="announcements-wrap">
    
    <div>
        <h1 class="page-header-title">Announcements & Updates</h1>
        <p class="page-header-sub">Stay informed with official updates from LEDIPO and your course instructors.</p>
    </div>

    {{-- Search & Filter Controls --}}
    <div class="announcement-filter-bar">
        <div class="search-box-wrap">
            <i class="fa fa-search"></i>
            <input type="text" id="announcementSearch" onkeyup="filterAnnouncements()" placeholder="Search announcements...">
        </div>

        <div class="filter-pills">
            <button class="filter-pill active" onclick="filterCategory('all', this)">All</button>
            <button class="filter-pill" onclick="filterCategory('urgent', this)">Urgent</button>
            <button class="filter-pill" onclick="filterCategory('schedule', this)">Schedules</button>
            <button class="filter-pill" onclick="filterCategory('general', this)">General</button>
        </div>
    </div>

    {{-- Announcement Stream --}}
<div class="announcements-feed" id="announcementFeed">

    @forelse ($announcements as $announcement)

        @php
            $type = strtolower($announcement->type ?? 'notice');

            // Map Admin announcement types to the Student page categories
            if ($type === 'urgent') {
                $category = 'urgent';
                $categoryLabel = 'Urgent Reminder';
                $badgeClass = 'badge-urgent';
            } elseif ($type === 'reminder') {
                $category = 'schedule';
                $categoryLabel = 'Schedule Notice';
                $badgeClass = 'badge-schedule';
            } else {
                $category = 'general';
                $categoryLabel = 'General';
                $badgeClass = 'badge-general';
            }

            $audienceLabel = match ($announcement->audience ?? 'general') {
                'student' => 'Students',
                'trainer' => 'Trainers',
                default => 'All Users',
            };
        @endphp

        <div class="announcement-card" data-category="{{ $category }}">

            {{-- Category --}}
            <span class="category-badge {{ $badgeClass }}">
                {{ $categoryLabel }}
            </span>

            {{-- Author --}}
            <div class="author-meta-row">

                <div class="author-avatar">
                    LD
                </div>

                <div class="author-info">

                    <div class="name">
                        LEDIPO Main Office
                    </div>

                    <div class="role-time">
                        Administrator • Posted
                        {{ $announcement->created_at?->format('M j, Y') }}
                    </div>

                </div>

            </div>

            {{-- Title --}}
            <h2 class="announcement-title">
                {{ $announcement->title }}
            </h2>

            {{-- Message --}}
            <p class="announcement-body">
                {{ $announcement->message }}
            </p>

            {{-- Footer --}}
            <div class="announcement-footer">

                <span>
                    Target Group: {{ $audienceLabel }}
                </span>

                <div class="footer-actions">

                    <button
                        class="action-btn"
                        type="button"
                        onclick="shareAnnouncement(this)"
                    >
                        <i class="fa fa-share"></i>
                        Share
                    </button>

                </div>

            </div>

        </div>

    @empty

        <div
            style="
                text-align: center;
                padding: 60px 20px;
                background: #ffffff;
                border: 1px solid #E2E8F0;
                border-radius: 16px;
                color: #718096;
            "
        >
            <i
                class="fa-solid fa-bell-slash"
                style="
                    font-size: 32px;
                    color: #CBD5E0;
                    margin-bottom: 12px;
                "
            ></i>

            <h3
                style="
                    margin: 0 0 6px;
                    color: #2D3748;
                    font-size: 16px;
                "
            >
                No announcements yet
            </h3>

            <p
                style="
                    margin: 0;
                    font-size: 13px;
                "
            >
                There are currently no active announcements available.
            </p>
        </div>

    @endforelse

</div>
</div>
@endsection

@section('scripts')
<script>
function filterAnnouncements() {
    const input = document.getElementById('announcementSearch').value.toLowerCase();
    const cards = document.querySelectorAll('.announcement-card');

    cards.forEach(card => {
        const title = card.querySelector('.announcement-title').textContent.toLowerCase();
        const body  = card.querySelector('.announcement-body').textContent.toLowerCase();

        if (title.includes(input) || body.includes(input)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function filterCategory(cat, btn) {
    document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');

    const cards = document.querySelectorAll('.announcement-card');

    cards.forEach(card => {
        if (cat === 'all' || card.dataset.category === cat) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
@endsection