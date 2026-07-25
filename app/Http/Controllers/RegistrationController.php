<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    /**
     * GET /register — show step 1 (Learner's Profile).
     */
    public function showStep1()
    {
        return view('registrationform1');
    }

    /**
     * POST /register/step-2 — validate step 1, stash in session, move on.
     */
    public function saveStep1(Request $request)
    {
        $validated = $request->validate([
            'uli_number'          => ['nullable', 'string', 'max:50'],
            'entry_date'          => ['nullable', 'date'],
            'id_picture'          => ['nullable', 'image', 'max:4096'],

            'last_name'           => ['required', 'string', 'max:100'],
            'first_name'          => ['required', 'string', 'max:100'],
            'middle_name'         => ['nullable', 'string', 'max:100'],
            'address_street'      => ['nullable', 'string', 'max:150'],
            'address_barangay'    => ['nullable', 'string', 'max:100'],
            'address_city'        => ['nullable', 'string', 'max:100'],
            'address_province'    => ['nullable', 'string', 'max:100'],
            'address_district'    => ['nullable', 'string', 'max:100'],
            'address_region'      => ['nullable', 'string', 'max:100'],
            'email'               => ['nullable', 'email', 'max:150'],
            'contact_no'          => ['nullable', 'string', 'max:30'],
            'nationality'         => ['nullable', 'string', 'max:100'],
            'training_venue'      => ['nullable', 'string', 'max:150'],

            'sex'                 => ['nullable', 'in:Male,Female'],
            'employment_status'   => ['nullable', 'in:Employed,Unemployed'],
            'civil_status'        => ['nullable', 'in:Single,Married,Widowed,Separated,Solo Parent'],
            'birth_month'         => ['nullable', 'string', 'max:20'],
            'birth_day'           => ['nullable', 'string', 'max:2'],
            'birth_year'          => ['nullable', 'string', 'max:4'],
            'age'                 => ['nullable', 'integer', 'min:0', 'max:120'],
            'birthplace_city'     => ['nullable', 'string', 'max:100'],
            'birthplace_province' => ['nullable', 'string', 'max:100'],
            'birthplace_region'   => ['nullable', 'string', 'max:100'],
            'education_attainment'=> ['nullable', 'string', 'max:100'],
            'guardian_name'       => ['nullable', 'string', 'max:150'],
            'guardian_address'    => ['nullable', 'string', 'max:255'],
        ]);

        // Files can't survive a redirect, so upload now and carry the path instead.
        if ($request->hasFile('id_picture')) {
            $validated['id_picture_path'] = $request->file('id_picture')
                ->store('registrations/id_pictures', 'public');
        }

        Session::put('reg_step1', $validated);

        return redirect()->route('registration.step2.show');
    }

    /**
     * GET /register/step-2 — show step 2, but only if step 1 was completed.
     */
    public function showStep2()
    {
        if (! Session::has('reg_step1')) {
            return redirect()
                ->route('registration.step1')
                ->with('error', 'Please complete page 1 first.');
        }

        return view('registrationform2');
    }

    /**
     * POST /register/submit — validate step 2, merge with step 1, save to DB.
     */
    public function store(Request $request)
    {
        if (! Session::has('reg_step1')) {
            return redirect()
                ->route('registration.step1')
                ->with('error', 'Your session expired — please start again.');
        }

        $validated = $request->validate([
            'classification'                => ['nullable', 'array'],
            'classification.*'              => ['string'],
            'classification_other'          => ['nullable', 'string', 'max:150'],

            'disability_type'               => ['nullable', 'array'],
            'disability_type.*'             => ['string'],
            'disability_multiple_specify'   => ['nullable', 'string', 'max:150'],
            'disability_cause'              => ['nullable', 'in:Congenital/Inborn,Illness,Injury'],
            'disability_cause_other'        => ['nullable', 'string', 'max:150'],

            'course_name'                   => ['required', 'string', 'max:150'],
            'scholarship_package'           => ['nullable', 'string', 'max:150'],

            'privacy_consent'               => ['required', 'in:Agree,Disagree'],

            'date_accomplished'             => ['nullable', 'date'],
            'date_received'                 => ['nullable', 'date'],
            'photo_1x1'                      => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo_1x1')) {
            $validated['photo_1x1_path'] = $request->file('photo_1x1')
                ->store('registrations/photos_1x1', 'public');
        }

        $data = array_merge(Session::get('reg_step1'), $validated);
        $data['user_id'] = Auth::id();

        $registration = Registration::create($data);

        Session::forget('reg_step1');

        return redirect()
            ->route('registration.step1')
            ->with('success', "Registration submitted! Reference #{$registration->id}.");
    }
        public function adminShow(Registration $registration)
            {
                return view('admin.registrations_show', compact('registration'));
            }

            public function exportCsv()
            {
                $filename = 'registrations_' . now()->format('Y-m-d_His') . '.csv';

                $headers = [
                    'Content-Type'        => 'text/csv',
                    'Content-Disposition' => "attachment; filename=\"$filename\"",
                ];

                $columns = [
                    'ID', 'ULI Number', 'Entry Date', 'Last Name', 'First Name', 'Middle Name',
                    'Address Street', 'Barangay', 'City', 'Province', 'District', 'Region',
                    'Email', 'Contact No', 'Nationality', 'Training Venue',
                    'Sex', 'Civil Status', 'Employment Status',
                    'Birth Month', 'Birth Day', 'Birth Year', 'Age',
                    'Birthplace City', 'Birthplace Province', 'Birthplace Region',
                    'Educational Attainment', 'Guardian Name', 'Guardian Address',
                    'Classification', 'Classification Other',
                    'Disability Type', 'Disability Multiple Specify', 'Disability Cause', 'Disability Cause Other',
                    'Course Name', 'Scholarship Package', 'Privacy Consent',
                    'Date Accomplished', 'Date Received', 'Submitted At',
                ];

                $callback = function () use ($columns) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);

                    Registration::latest()->chunk(200, function ($rows) use ($file) {
                        foreach ($rows as $r) {
                            fputcsv($file, [
                                $r->id, $r->uli_number, optional($r->entry_date)->format('Y-m-d'),
                                $r->last_name, $r->first_name, $r->middle_name,
                                $r->address_street, $r->address_barangay, $r->address_city,
                                $r->address_province, $r->address_district, $r->address_region,
                                $r->email, $r->contact_no, $r->nationality, $r->training_venue,
                                $r->sex, $r->civil_status, $r->employment_status,
                                $r->birth_month, $r->birth_day, $r->birth_year, $r->age,
                                $r->birthplace_city, $r->birthplace_province, $r->birthplace_region,
                                $r->education_attainment, $r->guardian_name, $r->guardian_address,
                                implode('; ', $r->classification ?? []), $r->classification_other,
                                implode('; ', $r->disability_type ?? []), $r->disability_multiple_specify,
                                $r->disability_cause, $r->disability_cause_other,
                                $r->course_name, $r->scholarship_package, $r->privacy_consent,
                                optional($r->date_accomplished)->format('Y-m-d'),
                                optional($r->date_received)->format('Y-m-d'),
                                $r->created_at->format('Y-m-d H:i:s'),
                            ]);
                        }
                    });

                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }

}