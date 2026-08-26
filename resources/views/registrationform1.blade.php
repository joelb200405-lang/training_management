{{--
  registrationform1.blade.php
  Step 1 of 2 — Learner's Profile Form (TESDA MIS 03-01)

  Wiring notes (adjust to your app):
  - This view posts to route('registration.step2'). Define that route/controller
    to validate + stash this step's input (e.g. session(['reg_step1' => $request->all()]))
    then redirect to the registrationform2 view.
  - Example routes/web.php:
      Route::get('/register', [RegistrationController::class, 'showStep1'])->name('registration.step1');
      Route::post('/register/step-2', [RegistrationController::class, 'saveStep1'])->name('registration.step2');
--}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Learner's Profile Form — TESDA</title>
  <style>
    :root {
      --navy: #025628;
      --navy-deep: #013d1c;
      --paper: #f3f6f4;
      --line: #cfd9d3;
      --ink: #1c2420;
      --muted: #5c6b62;
      --field-bg: #ffffff;
      --accent-soft: #eaf2ec;
      --radius: 6px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: "Georgia", "Times New Roman", serif;
      background: var(--paper);
      color: var(--ink);
      padding: 32px 16px 80px;
    }

    .sheet {
      max-width: 880px;
      margin: 0 auto;
      background: #fff;
      border: 1px solid var(--line);
      box-shadow: 0 2px 24px rgba(13, 47, 94, 0.08);
    }

    .letterhead {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-deep) 100%);
      color: #fff;
      padding: 22px 28px;
      display: flex;
      align-items: center;
      gap: 18px;
      position: relative;
      overflow: hidden;
    }

    .letterhead::after {
      content: "";
      position: absolute;
      right: -40px;
      top: -40px;
      width: 160px;
      height: 160px;
      border: 2px solid rgba(255, 255, 255, 0.25);
      border-radius: 50%;
    }

    .crest {
      width: 56px;
      height: 56px;
      flex-shrink: 0;
      border-radius: 50%;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--navy);
      font-family: "Trebuchet MS", sans-serif;
      font-weight: 700;
      font-size: 11px;
      text-align: center;
      border: 2px solid var(--navy);
    }

    .letterhead .agency {
      font-family: "Trebuchet MS", sans-serif;
    }

    .agency .en {
      font-size: 13px;
      font-weight: 600;
      letter-spacing: .03em;
    }

    .agency .fil {
      font-size: 11px;
      color: #d7e6dc;
      margin-top: 2px;
    }

    .titlebar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 28px;
      border-bottom: 3px solid var(--navy);
      background: #fff;
    }

    .titlebar h1 {
      margin: 0;
      font-size: 26px;
      letter-spacing: .02em;
      color: var(--navy-deep);
      font-family: "Trebuchet MS", sans-serif;
    }

    .step-indicator {
      font-family: "Trebuchet MS", sans-serif;
      font-size: 11px;
      font-weight: 700;
      color: #fff;
      background: var(--navy);
      padding: 4px 12px;
      border-radius: 20px;
      letter-spacing: .03em;
    }

    .formcode {
      font-family: "Courier New", monospace;
      font-size: 11px;
      text-align: right;
      color: var(--muted);
      line-height: 1.4;
    }

    .section {
      padding: 20px 28px;
      border-bottom: 1px solid var(--line);
    }

    .section:last-of-type {
      border-bottom: none;
    }

    .section-head {
      display: flex;
      align-items: baseline;
      gap: 10px;
      margin-bottom: 14px;
    }

    .section-head .num {
      font-family: "Trebuchet MS", sans-serif;
      font-weight: 700;
      color: #fff;
      background: var(--navy);
      padding: 2px 10px;
      border-radius: 3px;
      font-size: 14px;
    }

    .section-head h2 {
      margin: 0;
      font-size: 16px;
      font-family: "Trebuchet MS", sans-serif;
      color: var(--navy-deep);
      text-transform: uppercase;
      letter-spacing: .04em;
    }

    .subhead {
      font-family: "Trebuchet MS", sans-serif;
      font-size: 12.5px;
      font-weight: 700;
      color: var(--navy);
      margin: 16px 0 8px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .subhead .dot {
      width: 6px;
      height: 6px;
      background: var(--navy);
      border-radius: 50%;
      display: inline-block;
    }

    .subhead .req {
      color: #b3261e;
      font-weight: 700;
      font-size: 11px;
    }

    .subhead .optional,
    label .optional {
      color: var(--muted);
      font-weight: 400;
      font-style: italic;
      font-size: 10.5px;
      text-transform: none;
      letter-spacing: 0;
    }

    .row {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
      margin-bottom: 12px;
    }

    .field {
      flex: 1 1 160px;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .field.small {
      flex: 0 1 110px;
    }

    .field.wide {
      flex: 2 1 260px;
    }

    label {
      font-family: "Trebuchet MS", sans-serif;
      font-size: 11px;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: .03em;
    }

    label .req {
      color: #b3261e;
      font-weight: 700;
    }

    input[type="text"],
    input[type="date"],
    input[type="email"],
    input[type="tel"],
    select {
      border: 1px solid var(--line);
      border-radius: var(--radius);
      padding: 8px 10px;
      font-family: "Trebuchet MS", sans-serif;
      font-size: 14px;
      background: var(--field-bg);
      color: var(--ink);
      width: 100%;
    }

    input:focus,
    select:focus {
      outline: 2px solid var(--navy);
      outline-offset: 1px;
      border-color: var(--navy);
    }

    .id-photo-wrap {
      display: flex;
      gap: 20px;
      align-items: flex-start;
      flex-wrap: wrap;
    }

    .id-photo {
      width: 130px;
      height: 150px;
      border: 2px dashed var(--line);
      border-radius: var(--radius);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color: var(--muted);
      font-family: "Trebuchet MS", sans-serif;
      font-size: 11px;
      text-align: center;
      cursor: pointer;
      background: var(--accent-soft);
      overflow: hidden;
      flex-shrink: 0;
    }

    .id-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .id-photo:hover {
      border-color: var(--navy);
    }

    .id-photo input {
      display: none;
    }

    .uli-block {
      flex: 1 1 260px;
    }

    .uli-single {
      font-family: "Courier New", monospace;
      letter-spacing: .03em;
    }

    .choice-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 10px 22px;
    }

    .choice {
      display: flex;
      align-items: center;
      gap: 6px;
      font-family: "Trebuchet MS", sans-serif;
      font-size: 13.5px;
    }

    .choice input {
      width: 15px;
      height: 15px;
      accent-color: var(--navy);
      cursor: pointer;
    }

    .two-col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0 32px;
    }

    @media (max-width:640px) {
      .two-col {
        grid-template-columns: 1fr;
      }
    }

    .edu-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 8px 24px;
    }

    @media (max-width:640px) {
      .edu-grid {
        grid-template-columns: 1fr;
      }
    }

    .footer-note {
      padding: 16px 28px 24px;
      font-family: "Trebuchet MS", sans-serif;
      font-size: 11px;
      color: var(--muted);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
    }

    .btn {
      background: var(--navy);
      color: #fff;
      border: none;
      padding: 12px 26px;
      border-radius: var(--radius);
      font-family: "Trebuchet MS", sans-serif;
      font-size: 14px;
      font-weight: 600;
      letter-spacing: .02em;
      cursor: pointer;
      transition: background .15s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn:hover {
      background: var(--navy-deep);
    }

    .error-text {
      font-family: "Trebuchet MS", sans-serif;
      font-size: 11px;
      color: #b3261e;
      margin-top: 3px;
    }
  </style>
</head>

<body>

  @php
    $step1 = $step1 ?? [];
  @endphp

  <form class="sheet" id="learnerForm" method="POST"
    action="{{ route('registration.step2') }}" enctype="multipart/form-data" novalidate>
    @csrf

    @if ($errors->any())
      <div style="background:#fdecea;border:1px solid #f5c6cb;color:#b3261e;padding:14px 20px;margin:20px 28px 0;border-radius:6px;font-family:'Trebuchet MS',sans-serif;font-size:13px;">
        <strong>Please fix the following before continuing:</strong>
        <ul style="margin:8px 0 0;padding-left:18px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="letterhead">
      <div class="crest">TESDA</div>
      <div class="agency">
        <div class="en">Technical Education and Skills Development Authority
        </div>
        <div class="fil">Pangasiwaan sa Edukasyong Teknikal at Pagpapaunlad
          ng Kaanyuan</div>
      </div>
    </div>

    <div class="titlebar">
      <h1>Registration Form</h1>
      <div style="display:flex; align-items:center; gap:14px;">
        <span class="step-indicator">Step 1 of 2</span>
        <div class="formcode">MIS 03&ndash;01<br>(rev. 2020)</div>
      </div>
    </div>

    <!-- 1. TE2MIS -->
    <div class="section">
      <div class="section-head">
        <span class="num">1</span>
        <h2>TE2MIS Auto Generated</h2>
      </div>
      <div class="id-photo-wrap">
        <div class="uli-block">
          <div class="row" style="margin-bottom:14px;">
            <div class="field wide">
              <label>1.1 Unique Learner Identifier (ULI) Number <span class="optional">(optional)</span></label>
              <input type="text" name="uli_number" class="uli-single"
                value="{{ old('uli_number', $step1['uli_number'] ?? '') }}"
                placeholder="e.g. 04-1234-56789012" maxlength="20">
            </div>
          </div>
          <div class="row">
            <div class="field small">
              <label>1.2 Entry Date <span class="optional">(optional)</span></label>
              <input type="date" name="entry_date"
                value="{{ old('entry_date', $step1['entry_date'] ?? '') }}">
            </div>
          </div>
        </div>
        <label class="id-photo" for="idPhotoInput">
          <span id="idPhotoText">
            @if (!empty($step1['id_picture_path']))
              Photo already uploaded.<br>Click to replace.
            @else
              Click to<br>upload<br>ID Picture
            @endif
            <br><span class="req">*</span></span>
          <img id="idPhotoPreview" style="display:none;">
          <input type="file" id="idPhotoInput" name="id_picture"
            accept="image/*" required>
        </label>
      </div>
    </div>

    <!-- 2. Learner/Manpower Profile -->
    <div class="section">
      <div class="section-head">
        <span class="num">2</span>
        <h2>Learner / Manpower Profile</h2>
      </div>

      <div class="subhead"><span class="dot"></span>2.1 Name</div>
      <div class="row">
        <div class="field wide"><label>Last Name, Extension (Jr.,
            Sr.) <span class="req">*</span></label><input type="text" name="last_name"
            value="{{ old('last_name', $step1['last_name'] ?? '') }}" required></div>
        <div class="field wide"><label>First Name <span class="req">*</span></label><input type="text"
            name="first_name" value="{{ old('first_name', $step1['first_name'] ?? '') }}" required></div>
        <div class="field wide"><label>Middle Name <span class="optional">(optional)</span></label><input type="text"
            name="middle_name" value="{{ old('middle_name', $step1['middle_name'] ?? '') }}"></div>
      </div>

      <div class="subhead"><span class="dot"></span>2.2 Complete Permanent
        Mailing Address</div>
      <div class="row">
        <div class="field wide"><label>Number, Street <span class="req">*</span></label><input
            type="text" name="address_street"
            value="{{ old('address_street', $step1['address_street'] ?? '') }}" required></div>
        <div class="field"><label>Barangay <span class="req">*</span></label><input type="text"
            name="address_barangay" value="{{ old('address_barangay', $step1['address_barangay'] ?? '') }}" required></div>
      </div>
      <div class="row">
        <div class="field"><label>City / Municipality <span class="req">*</span></label><input
            type="text" name="address_city"
            value="{{ old('address_city', $step1['address_city'] ?? '') }}" required></div>
        <div class="field"><label>Province <span class="req">*</span></label><input type="text"
            name="address_province" value="{{ old('address_province', $step1['address_province'] ?? '') }}" required></div>
        <div class="field"><label>District <span class="optional">(optional)</span></label><input type="text"
            name="address_district" value="{{ old('address_district', $step1['address_district'] ?? '') }}">
        </div>
        <div class="field"><label>Region <span class="optional">(optional)</span></label><input type="text"
            name="address_region" value="{{ old('address_region', $step1['address_region'] ?? '') }}"></div>
      </div>
      <div class="row">
        <div class="field wide"><label>Email Address / Facebook
            Account <span class="req">*</span></label><input type="email" name="email"
            value="{{ old('email', $step1['email'] ?? '') }}" required></div>
        <div class="field"><label>Contact No. <span class="req">*</span></label><input type="tel"
            name="contact_no" value="{{ old('contact_no', $step1['contact_no'] ?? '') }}" required></div>
        <div class="field"><label>Nationality <span class="req">*</span></label><input type="text"
            name="nationality" value="{{ old('nationality', $step1['nationality'] ?? '') }}" required></div>
      </div>

      <div class="subhead"><span class="dot"></span>2.3 Training Venue <span class="req">*</span>
      </div>
      <div class="row">
        <div class="field wide"><input type="text" name="training_venue"
            value="{{ old('training_venue', $step1['training_venue'] ?? '') }}"
            placeholder="Name of training center / venue" required></div>
      </div>
    </div>

    <!-- 3. Personal Information -->
    <div class="section">
      <div class="section-head">
        <span class="num">3</span>
        <h2>Personal Information</h2>
      </div>

      <div class="two-col">
        <div>
          <div class="subhead"><span class="dot"></span>3.1 Sex <span class="req">*</span></div>
          <div class="choice-grid">
            <label class="choice"><input type="radio" name="sex"
                value="Male" required
                @if (old('sex', $step1['sex'] ?? '') == 'Male') checked @endif> Male</label>
            <label class="choice"><input type="radio" name="sex"
                value="Female"
                @if (old('sex', $step1['sex'] ?? '') == 'Female') checked @endif> Female</label>
          </div>
        </div>
        <div>
          <div class="subhead"><span class="dot"></span>3.3 Employment
            Status <span
              style="font-weight:400;color:var(--muted);text-transform:none;">(before
              training)</span> <span class="req">*</span></div>
          <div class="choice-grid">
            <label class="choice"><input type="radio"
                name="employment_status" value="Employed" required
                @if (old('employment_status', $step1['employment_status'] ?? '') == 'Employed') checked @endif>
              Employed</label>
            <label class="choice"><input type="radio"
                name="employment_status" value="Unemployed"
                @if (old('employment_status', $step1['employment_status'] ?? '') == 'Unemployed') checked @endif>
              Unemployed</label>
          </div>
        </div>
      </div>

      <div class="subhead"><span class="dot"></span>3.2 Civil Status <span class="req">*</span></div>
      <div class="choice-grid" style="margin-bottom:6px;">
        <label class="choice"><input type="radio" name="civil_status"
            value="Single" required @if (old('civil_status', $step1['civil_status'] ?? '') == 'Single') checked @endif>
          Single</label>
        <label class="choice"><input type="radio" name="civil_status"
            value="Married" @if (old('civil_status', $step1['civil_status'] ?? '') == 'Married') checked @endif>
          Married</label>
        <label class="choice"><input type="radio" name="civil_status"
            value="Widowed" @if (old('civil_status', $step1['civil_status'] ?? '') == 'Widowed') checked @endif>
          Widowed</label>
        <label class="choice"><input type="radio" name="civil_status"
            value="Separated" @if (old('civil_status', $step1['civil_status'] ?? '') == 'Separated') checked @endif>
          Separated</label>
        <label class="choice"><input type="radio" name="civil_status"
            value="Solo Parent"
            @if (old('civil_status', $step1['civil_status'] ?? '') == 'Solo Parent') checked @endif> Solo
          Parent</label>
      </div>

      <div class="subhead"><span class="dot"></span>3.4 Birthdate <span class="req">*</span></div>
      <div class="row">
        <div class="field"><label>Month of Birth</label><input type="text"
            name="birth_month" value="{{ old('birth_month', $step1['birth_month'] ?? '') }}"
            placeholder="e.g. January" required></div>
        <div class="field small"><label>Day of Birth</label><input
            type="text" name="birth_day" value="{{ old('birth_day', $step1['birth_day'] ?? '') }}"
            placeholder="DD" required></div>
        <div class="field small"><label>Year of Birth</label><input
            type="text" name="birth_year" value="{{ old('birth_year', $step1['birth_year'] ?? '') }}"
            placeholder="YYYY" required></div>
        <div class="field small"><label>Age</label><input type="text"
            name="age" value="{{ old('age', $step1['age'] ?? '') }}" required></div>
      </div>

      <div class="subhead"><span class="dot"></span>3.5 Birthplace <span class="optional">(optional)</span></div>
      <div class="row">
        <div class="field"><label>City / Municipality</label><input
            type="text" name="birthplace_city"
            value="{{ old('birthplace_city', $step1['birthplace_city'] ?? '') }}"></div>
        <div class="field"><label>Province</label><input type="text"
            name="birthplace_province"
            value="{{ old('birthplace_province', $step1['birthplace_province'] ?? '') }}"></div>
        <div class="field"><label>Region</label><input type="text"
            name="birthplace_region" value="{{ old('birthplace_region', $step1['birthplace_region'] ?? '') }}">
        </div>
      </div>

      <div class="subhead"><span class="dot"></span>3.6 Educational
        Attainment Before the Training (Trainee) <span class="req">*</span></div>
      @php
        $eduOptions = [
            'No Grade Completed',
            'Pre-School (Nursery/Kinder/Prep)',
            'High School Undergraduate',
            'High School Graduate',
            'Junior High School Graduate',
            'Senior High School Graduate',
            'Elementary Undergraduate',
            'Elementary Graduate',
            'Post Secondary Undergraduate',
            'Post Secondary Graduate',
            'College Undergraduate',
            'College Graduate or Higher',
        ];
      @endphp
      <div class="edu-grid">
        @foreach ($eduOptions as $i => $opt)
          <label class="choice">
            <input type="radio" name="education_attainment"
              value="{{ $opt }}" @if ($i === 0) required @endif
              @if (old('education_attainment', $step1['education_attainment'] ?? '') == $opt) checked @endif>
            {{ $opt }}
          </label>
        @endforeach
      </div>

      <div class="subhead"><span class="dot"></span>3.7 Parent / Guardian <span class="optional">(optional)</span>
      </div>
      <div class="row">
        <div class="field wide"><label>Name</label><input type="text"
            name="guardian_name" value="{{ old('guardian_name', $step1['guardian_name'] ?? '') }}"></div>
      </div>
      <div class="row">
        <div class="field wide"><label>Complete Permanent Mailing
            Address</label><input type="text" name="guardian_address"
            value="{{ old('guardian_address', $step1['guardian_address'] ?? '') }}"></div>
      </div>
    </div>

    <div class="footer-note">
      <span><span class="req">*</span> Required fields. Please review all entries before proceeding. Fields marked with a
        section number correspond to the official TESDA Registration Form (MIS
        03-01).</span>
    </div>
    <div class="footer-note" style="padding-top:0;">
      <button type="submit" class="btn">Next Page &rarr;</button>
    </div>

  </form>

  <script>
    const photoInput = document.getElementById('idPhotoInput');
    const photoPreview = document.getElementById('idPhotoPreview');
    const photoText = document.getElementById('idPhotoText');
    photoInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = (ev) => {
        photoPreview.src = ev.target.result;
        photoPreview.style.display = 'block';
        photoText.style.display = 'none';
      };
      reader.readAsDataURL(file);
    });

    // Use the browser's native validation UI, but keep our own styling (novalidate removed on submit check)
    const form = document.getElementById('learnerForm');
    form.addEventListener('submit', (e) => {
      // The file input is visually hidden (display:none) behind the styled label,
      // so the browser can't show its native "please fill this out" bubble on it.
      // That silently blocks submission with no visible feedback. Check it manually first.
      if (!photoInput.files || photoInput.files.length === 0) {
        e.preventDefault();
        alert('Please upload an ID picture before proceeding.');
        document.querySelector('.id-photo').scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
      }

      if (!form.checkValidity()) {
        e.preventDefault();
        form.reportValidity();
      }
    });
  </script>

</body>

</html>