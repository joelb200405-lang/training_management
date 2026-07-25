<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
    h1 { font-size: 18px; color: #025628; margin-bottom: 4px; }
    .sub { font-size: 11px; color: #777; margin-bottom: 18px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
    td { padding: 5px 8px; vertical-align: top; }
    .section-title {
        background: #025628; color: #fff; font-size: 12px; font-weight: bold;
        padding: 6px 10px; margin-top: 14px; margin-bottom: 6px;
    }
    .label { font-size: 9px; color: #888; text-transform: uppercase; }
    .value { font-size: 12px; color: #222; }
    .chip { background: #e6f4eb; color: #276749; padding: 2px 6px; font-size: 10px; margin-right: 4px; }
</style>
</head>
<body>

    <h1>TESDA Registration Form</h1>
    <div class="sub">Registration #{{ $registration->id }} &nbsp;·&nbsp; Submitted {{ $registration->created_at->format('M j, Y g:i A') }}</div>

    <div class="section-title">Learner / Manpower Profile</div>
    <table>
        <tr>
            <td width="33%"><div class="label">ULI Number</div><div class="value">{{ $registration->uli_number ?? '—' }}</div></td>
            <td width="33%"><div class="label">Entry Date</div><div class="value">{{ optional($registration->entry_date)->format('M j, Y') ?? '—' }}</div></td>
            <td width="34%"><div class="label">Full Name</div><div class="value">{{ $registration->last_name }}, {{ $registration->first_name }} {{ $registration->middle_name }}</div></td>
        </tr>
        <tr>
            <td><div class="label">Email</div><div class="value">{{ $registration->email ?? '—' }}</div></td>
            <td><div class="label">Contact No.</div><div class="value">{{ $registration->contact_no ?? '—' }}</div></td>
            <td><div class="label">Nationality</div><div class="value">{{ $registration->nationality ?? '—' }}</div></td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="label">Complete Permanent Mailing Address</div>
                <div class="value">
                    {{ $registration->address_street }}, {{ $registration->address_barangay }},
                    {{ $registration->address_city }}, {{ $registration->address_province }},
                    {{ $registration->address_district }}, {{ $registration->address_region }}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3"><div class="label">Training Venue</div><div class="value">{{ $registration->training_venue ?? '—' }}</div></td>
        </tr>
    </table>

    <div class="section-title">Personal Information</div>
    <table>
        <tr>
            <td width="33%"><div class="label">Sex</div><div class="value">{{ $registration->sex ?? '—' }}</div></td>
            <td width="33%"><div class="label">Civil Status</div><div class="value">{{ $registration->civil_status ?? '—' }}</div></td>
            <td width="34%"><div class="label">Employment Status</div><div class="value">{{ $registration->employment_status ?? '—' }}</div></td>
        </tr>
        <tr>
            <td><div class="label">Birthdate</div><div class="value">{{ $registration->birth_month }} {{ $registration->birth_day }}, {{ $registration->birth_year }}</div></td>
            <td><div class="label">Age</div><div class="value">{{ $registration->age ?? '—' }}</div></td>
            <td><div class="label">Birthplace</div><div class="value">{{ $registration->birthplace_city }}, {{ $registration->birthplace_province }}, {{ $registration->birthplace_region }}</div></td>
        </tr>
        <tr>
            <td><div class="label">Educational Attainment</div><div class="value">{{ $registration->education_attainment ?? '—' }}</div></td>
            <td colspan="2"><div class="label">Parent/Guardian</div><div class="value">{{ $registration->guardian_name ?? '—' }} — {{ $registration->guardian_address ?? '—' }}</div></td>
        </tr>
    </table>

    <div class="section-title">Classification &amp; Disability</div>
    <table>
        <tr>
            <td>
                <div class="label">Learner/Trainee/Student Classification</div>
                <div class="value">
                    @forelse($registration->classification ?? [] as $c)
                        <span class="chip">{{ $c }}</span>
                    @empty
                        —
                    @endforelse
                    @if($registration->classification_other)
                        <br>Other: {{ $registration->classification_other }}
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="label">Type of Disability</div>
                <div class="value">
                    @forelse($registration->disability_type ?? [] as $d)
                        <span class="chip">{{ $d }}</span>
                    @empty
                        —
                    @endforelse
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="label">Cause of Disability</div>
                <div class="value">{{ $registration->disability_cause ?? '—' }} {{ $registration->disability_cause_other ? '— ' . $registration->disability_cause_other : '' }}</div>
            </td>
        </tr>
    </table>

    <div class="section-title">Course &amp; Scholarship</div>
    <table>
        <tr>
            <td width="50%"><div class="label">Course / Qualification</div><div class="value">{{ $registration->course_name }}</div></td>
            <td width="50%"><div class="label">Scholarship Package</div><div class="value">{{ $registration->scholarship_package ?? '—' }}</div></td>
        </tr>
        <tr>
            <td><div class="label">Privacy Consent</div><div class="value">{{ $registration->privacy_consent }}</div></td>
        </tr>
    </table>

    <div class="section-title">Signature</div>
    <table>
        <tr>
            <td width="50%"><div class="label">Date Accomplished</div><div class="value">{{ optional($registration->date_accomplished)->format('M j, Y') ?? '—' }}</div></td>
            <td width="50%"><div class="label">Date Received</div><div class="value">{{ optional($registration->date_received)->format('M j, Y') ?? '—' }}</div></td>
        </tr>
    </table>

</body>
</html>