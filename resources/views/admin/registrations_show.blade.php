@php
  $pageTitle = 'Registration #' . $registration->id . ' · LEDIPO Admin';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $pageTitle }}</title>
  <style>
    body {
      margin: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      background: #f4f6f0;
      color: #2d3748;
    }

    .page-wrap {
      max-width: 900px;
      margin: 0 auto;
      padding: 28px 20px 60px;
    }

    .detail-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 12px;
    }

    .detail-header h2 {
      font-size: 22px;
      font-weight: 700;
      color: #1a4d2e;
      margin: 0;
    }

    .back-link {
      color: #1a4d2e;
      font-weight: 600;
      text-decoration: none;
      font-size: 13px;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    .detail-card {
      background: #fff;
      border-radius: 12px;
      border: 0.5px solid #e2e8f0;
      padding: 20px 24px;
      margin-bottom: 20px;
    }

    .detail-card h3 {
      font-size: 13px;
      font-weight: 700;
      color: #1a4d2e;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      margin: 0 0 14px;
      padding-bottom: 8px;
      border-bottom: 1px solid #f0f4f8;
    }

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 14px 20px;
    }

    .detail-field label {
      display: block;
      font-size: 11px;
      color: #a0aec0;
      text-transform: uppercase;
      letter-spacing: 0.03em;
      margin-bottom: 3px;
    }

    .detail-field span {
      font-size: 14px;
      color: #2d3748;
      font-weight: 500;
    }

    .chip-list {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
    }

    .chip {
      background: #e6f4eb;
      color: #276749;
      font-size: 12px;
      padding: 3px 10px;
      border-radius: 999px;
    }

    .photo-block {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      margin-top: 6px;
    }

    .photo-block img {
      width: 120px;
      height: 130px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid #e2e8f0;
    }

    .photo-caption {
      font-size: 11px;
      color: #a0aec0;
      text-align: center;
      margin-top: 4px;
    }
  </style>
</head>

<body>
  <div class="page-wrap">

    <div class="detail-header">
      <h2>Registration #{{ $registration->id }}</h2>
      <a href="{{ route('admin1') }}?view=registrations" class="back-link">&larr;
        Back to list</a>
    </div>

    <div class="detail-card">
      <h3>Learner / Manpower Profile</h3>
      <div class="detail-grid">
        <div class="detail-field"><label>ULI
            Number</label><span>{{ $registration->uli_number ?? '—' }}</span>
        </div>
        <div class="detail-field"><label>Entry
            Date</label><span>{{ optional($registration->entry_date)->format('M j, Y') ?? '—' }}</span>
        </div>
        <div class="detail-field"><label>Full
            Name</label><span>{{ $registration->last_name }},
            {{ $registration->first_name }}
            {{ $registration->middle_name }}</span></div>
        <div class="detail-field">
          <label>Email</label><span>{{ $registration->email ?? '—' }}</span>
        </div>
        <div class="detail-field"><label>Contact
            No.</label><span>{{ $registration->contact_no ?? '—' }}</span></div>
        <div class="detail-field">
          <label>Nationality</label><span>{{ $registration->nationality ?? '—' }}</span>
        </div>
        <div class="detail-field"><label>Training
            Venue</label><span>{{ $registration->training_venue ?? '—' }}</span>
        </div>
      </div>
      <div class="detail-grid" style="margin-top:14px;">
        <div class="detail-field" style="grid-column:1/-1;">
          <label>Complete Permanent Mailing Address</label>
          <span>
            {{ $registration->address_street }},
            {{ $registration->address_barangay }},
            {{ $registration->address_city }},
            {{ $registration->address_province }},
            {{ $registration->address_district }},
            {{ $registration->address_region }}
          </span>
        </div>
      </div>
    </div>

    <div class="detail-card">
      <h3>Personal Information</h3>
      <div class="detail-grid">
        <div class="detail-field">
          <label>Sex</label><span>{{ $registration->sex ?? '—' }}</span></div>
        <div class="detail-field"><label>Civil
            Status</label><span>{{ $registration->civil_status ?? '—' }}</span>
        </div>
        <div class="detail-field"><label>Employment
            Status</label><span>{{ $registration->employment_status ?? '—' }}</span>
        </div>
        <div class="detail-field">
          <label>Birthdate</label><span>{{ $registration->birth_month }}
            {{ $registration->birth_day }},
            {{ $registration->birth_year }}</span></div>
        <div class="detail-field">
          <label>Age</label><span>{{ $registration->age ?? '—' }}</span></div>
        <div class="detail-field">
          <label>Birthplace</label><span>{{ $registration->birthplace_city }},
            {{ $registration->birthplace_province }},
            {{ $registration->birthplace_region }}</span></div>
        <div class="detail-field"><label>Educational
            Attainment</label><span>{{ $registration->education_attainment ?? '—' }}</span>
        </div>
        <div class="detail-field">
          <label>Parent/Guardian</label><span>{{ $registration->guardian_name ?? '—' }}</span>
        </div>
        <div class="detail-field" style="grid-column:1/-1;"><label>Guardian
            Address</label><span>{{ $registration->guardian_address ?? '—' }}</span>
        </div>
      </div>
    </div>

    <div class="detail-card">
      <h3>Classification &amp; Disability</h3>
      <div class="detail-field" style="margin-bottom:14px;">
        <label>Learner/Trainee/Student Classification</label>
        <div class="chip-list">
          @forelse($registration->classification ?? [] as $c)
            <span class="chip">{{ $c }}</span>
          @empty
            <span>—</span>
          @endforelse
        </div>
        @if ($registration->classification_other)
          <div style="margin-top:6px;font-size:13px;color:#4a5568;">Other:
            {{ $registration->classification_other }}</div>
        @endif
      </div>
      <div class="detail-field" style="margin-bottom:14px;">
        <label>Type of Disability</label>
        <div class="chip-list">
          @forelse($registration->disability_type ?? [] as $d)
            <span class="chip">{{ $d }}</span>
          @empty
            <span>—</span>
          @endforelse
        </div>
      </div>
      <div class="detail-grid">
        <div class="detail-field"><label>Cause of
            Disability</label><span>{{ $registration->disability_cause ?? '—' }}</span>
        </div>
        <div class="detail-field"><label>Other
            Cause</label><span>{{ $registration->disability_cause_other ?? '—' }}</span>
        </div>
      </div>
    </div>

    <div class="detail-card">
      <h3>Course &amp; Scholarship</h3>
      <div class="detail-grid">
        <div class="detail-field"><label>Course /
            Qualification</label><span>{{ $registration->course_name }}</span>
        </div>
        <div class="detail-field"><label>Scholarship
            Package</label><span>{{ $registration->scholarship_package ?? '—' }}</span>
        </div>
        <div class="detail-field"><label>Privacy
            Consent</label><span>{{ $registration->privacy_consent }}</span>
        </div>
      </div>
    </div>

    <div class="detail-card">
      <h3>Signature &amp; Photos</h3>
      <div class="detail-grid" style="margin-bottom:14px;">
        <div class="detail-field"><label>Date
            Accomplished</label><span>{{ optional($registration->date_accomplished)->format('M j, Y') ?? '—' }}</span>
        </div>
        <div class="detail-field"><label>Date
            Received</label><span>{{ optional($registration->date_received)->format('M j, Y') ?? '—' }}</span>
        </div>
      </div>
      <div class="photo-block">
        <div>
          @if ($registration->id_picture_path)
            <img src="{{ asset('storage/' . $registration->id_picture_path) }}"
              alt="ID Picture">
          @else
            <div
              style="width:120px;height:130px;border:1px dashed #e2e8f0;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#a0aec0;font-size:11px;text-align:center;">
              No ID photo</div>
          @endif
          <div class="photo-caption">ID Picture</div>
        </div>
        <div>
          @if ($registration->photo_1x1_path)
            <img src="{{ asset('storage/' . $registration->photo_1x1_path) }}"
              alt="1x1 Photo">
          @else
            <div
              style="width:120px;height:130px;border:1px dashed #e2e8f0;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#a0aec0;font-size:11px;text-align:center;">
              No 1x1 photo</div>
          @endif
          <div class="photo-caption">1x1 Picture</div>
        </div>
      </div>
    </div>

  </div>
</body>

</html>
