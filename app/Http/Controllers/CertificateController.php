<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course_tbl;
use App\Models\User_tbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificateController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trainee_id'     => 'required|exists:user_tbls,id',
            'course_id'      => 'nullable',
            'certificate_no' => 'required|string|unique:certificates,certificate_no',
            'issue_date'     => 'required|date',
            'document_type'  => 'required|string',
            'remarks'        => 'nullable|string',
        ]);

        // 1. Get course ID from request, enrollment table, or the first active course in DB
        $courseId = $request->input('course_id');
        if (!$courseId) {
            $enrollment = DB::table('enrollment_tbls')
                ->where('user_id', $validated['trainee_id'])
                ->first();
            $courseId = $enrollment ? $enrollment->course_id : DB::table('course_tbls')->value('id');
        }

        // 2. Insert into database
        $certificate = Certificate::create([
            'user_id'        => $validated['trainee_id'],
            'course_id'      => $courseId,
            'certificate_no' => $validated['certificate_no'],
            'training_id'    => 'NCIIDRM-26-032',
            'document_type'  => $validated['document_type'],
            'issue_date'     => $validated['issue_date'],
            'status'         => 'Pending',
            'grade'          => '94%',
            'remarks'        => $validated['remarks'] ?? null,
        ]);

        $certificate->load(['user', 'course']);

        return response()->json([
            'success' => true,
            'message' => 'Certificate issued and recorded in database!',
            'certificate' => [
                'id'             => $certificate->id,
                'certificate_no' => $certificate->certificate_no,
                'full_name'      => trim(($certificate->user->firstname ?? '') . ' ' . ($certificate->user->lastname ?? '')),
                'course'         => $certificate->course->title ?? 'General Training',
                'issue_date'     => \Carbon\Carbon::parse($certificate->issue_date)->format('F j, Y'),
                'status'         => $certificate->status,
                'grade'          => $certificate->grade ?? '94%',
                'document_type'  => $certificate->document_type
            ]
        ]);
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Certificate record deleted successfully!'
        ]);
    }

    public function toggleStatus($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->status = strtolower($certificate->status) === 'claimed' ? 'Pending' : 'Claimed';
        $certificate->save();

        return response()->json([
            'success'    => true,
            'new_status' => $certificate->status,
            'message'    => "Status changed to {$certificate->status}"
        ]);
    }
}