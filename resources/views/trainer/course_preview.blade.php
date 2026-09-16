@extends('trainer.layout')

@section('title', 'Course Preview')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div style="padding:28px;max-width:900px;">

    <a href="{{ route('trainer.courses') }}" style="display:inline-block;margin-bottom:16px;border:1px solid #025628;color:#025628;padding:6px 16px;border-radius:20px;font-size:12px;font-weight:700;text-decoration:none;">
        ← Back to My Courses
    </a>

    <h1 style="font-size:24px;font-weight:800;color:#025628;text-transform:uppercase;margin-bottom:16px;">
        {{ $course->title }}
    </h1>

    <div style="background:#025628;color:#fff;border-radius:16px;padding:20px 28px;margin-bottom:24px;">
        <div style="font-size:13px;">
            Duration: {{ $course->duration ?? 'TBA' }} Days &nbsp;|&nbsp;
            Schedule: {{ $course->schedule ?? 'TBA' }}
        </div>
    </div>

            <div style="margin-bottom:20px;">
                <div style="font-size:12px;font-weight:700;color:#718096;text-transform:uppercase;margin-bottom:6px;">Description</div>
                <textarea id="descriptionInput" rows="3"
                    style="width:100%;max-width:700px;font-size:14px;color:#333;font-family:inherit;border:1px solid #ddd;border-radius:8px;padding:10px;resize:vertical;">{{ $course->description }}</textarea>
                <button onclick="saveDescription()" style="margin-top:8px;background:#025628;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer;">
                    Save Description
                </button>
            </div>

        <div style="margin-bottom:20px;">
            <div style="font-size:12px;font-weight:700;color:#718096;text-transform:uppercase;margin-bottom:6px;">Objectives</div>
            <textarea id="objectivesInput" rows="3"
                style="width:100%;max-width:700px;font-size:14px;color:#333;font-family:inherit;border:1px solid #ddd;border-radius:8px;padding:10px;resize:vertical;">{{ $course->objectives }}</textarea>
            <button onclick="saveObjectives()" style="margin-top:8px;background:#025628;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer;">
                Save Objectives
            </button>
        </div>

    <hr style="border:none;border-top:1px solid #e2e8f0;margin:24px 0;">

    <div style="font-size:12px;font-weight:700;color:#718096;text-transform:uppercase;margin-bottom:10px;">Modules</div>

    @forelse ($modules as $i => $module)
        <div style="background:#cbd5e0;border-radius:12px;padding:14px 20px;margin-bottom:10px;">
            <div style="font-weight:700;font-size:14px;color:#2d3748;">{{ $i + 1 }}. {{ $module->title }}</div>
            @if ($module->description)
                <div style="font-size:12px;color:#718096;margin-top:2px;">{{ $module->description }}</div>
            @endif
        </div>
    @empty
        <div style="color:#a0aec0;font-size:13px;padding:16px 0;">No modules added yet.</div>
    @endforelse

    {{-- ============================================================
     MODAL: Custom Alert Card (replaces native alert())
     ============================================================ --}}
    <div id="mcAlertModal" style="display:none;position:fixed;z-index:3000;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.5);">
    <div style="background:#fff;margin:10% auto;border-radius:14px;width:90%;max-width:380px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.2);">
        <div style="background:#fcfcfc;padding:18px 24px;border-bottom:1px solid #eee;display:flex;justify-content:space-between;align-items:center;">
        <h3 style="color:#025628;margin:0;font-size:16px;"><i class="fa fa-circle-info"></i> Notice</h3>
        <span onclick="closeAlertModal()" style="font-size:22px;color:#aaa;cursor:pointer;">&times;</span>
        </div>
        <div style="padding:24px;text-align:center;">
        <p id="mcAlertMessage" style="font-size:14px;color:#333;margin:0;"></p>
        </div>
        <div style="padding:16px 24px;background:#fcfcfc;border-top:1px solid #eee;display:flex;justify-content:center;">
        <button onclick="closeAlertModal()" style="background:#025628;color:#fff;border:none;border-radius:8px;padding:9px 24px;font-size:13px;font-weight:700;cursor:pointer;">
            OK
        </button>
        </div>
    </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    function showAlert(message) {
    document.getElementById('mcAlertMessage').textContent = message;
    document.getElementById('mcAlertModal').style.display = 'block';
    }

    function closeAlertModal() {
    document.getElementById('mcAlertModal').style.display = 'none';
    }

    function saveDescription() {
        fetch(`/trainer/course/{{ $course->id }}/description`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ description: document.getElementById('descriptionInput').value })
        })
        .then(r => r.json())
        .then(data => { if (data.success) showAlert('Description updated!'); })
        .catch(() => showAlert('Something went wrong. Please try again.'));
    }

    function saveObjectives() {
        fetch(`/trainer/course/{{ $course->id }}/objectives`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ objectives: document.getElementById('objectivesInput').value })
        })
        .then(r => r.json())
        .then(data => { if (data.success) showAlert('Objectives updated!'); })
        .catch(() => showAlert('Something went wrong. Please try again.'));
    }
</script>
@endsection