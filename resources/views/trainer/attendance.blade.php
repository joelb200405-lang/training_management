@extends('trainer.layout')

@section('title', 'Attendance · LEDIPO Trainer')

@section('css')
  <style>
    .main-content { background: #f4f6f0; }

    .att-header {
      background: #1a4d2e;
      border-radius: 14px;
      padding: 20px 28px;
      color: white;
      margin-bottom: 24px;
    }

    .att-header h2 { font-size: 22px; font-weight: 700; color: white; margin: 0; }
    .att-header p { font-size: 13px; color: #b6d9c0; margin: 4px 0 0; }

    .tbl-card {
      background: white;
      border-radius: 12px;
      border: 0.5px solid #e2e8f0;
      overflow: hidden;
      margin-bottom: 24px;
    }

    .tbl-card table { width: 100%; border-collapse: collapse; font-size: 14px; }

    .tbl-card th {
      font-size: 11px;
      color: #a0aec0;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      padding: 12px 18px;
      text-align: left;
      border-bottom: 0.5px solid #f0f4f8;
    }

    .tbl-card td {
      padding: 12px 18px;
      color: #4a5568;
      border-bottom: 0.5px solid #f8f9fa;
    }

    .tbl-card tr:last-child td { border-bottom: none; }

    .absent-check { display: flex; align-items: center; gap: 8px; }
    .absent-check input { width: 18px; height: 18px; }

    .submit-btn {
      background: #1a4d2e;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 12px 28px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
    }

    .submit-btn:hover { background: #163f27; }

    .no-data { color: #a0aec0; font-size: 13px; text-align: center; padding: 24px; }

    .alert-success {
      background: #e6f4eb;
      color: #276749;
      padding: 12px 18px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 13px;
    }
  </style>
@endsection

@section('content')
  <div style="padding: 24px;">

    <div class="att-header">
      <h2>Take Attendance</h2>
      <p>{{ $today }} @if($course) · {{ $course->title }} @endif</p>
    </div>

    @if (session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="tbl-card">
      @if (!$course)
        <div class="no-data">No course is assigned to you yet.</div>
      @elseif ($students->isEmpty())
        <div class="no-data">No active students enrolled in this course.</div>
      @else
        <form method="POST" action="{{ route('trainer.attendance.store') }}">
          @csrf
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Today's status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $student)
                <tr>
                  <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                  <td>
                    <label class="absent-check">
                      <input type="checkbox" name="absent[]" value="{{ $student->enrollment_id }}"
                        {{ ($existing[$student->enrollment_id] ?? 'present') === 'absent' ? 'checked' : '' }}>
                      Mark absent
                    </label>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div style="padding: 18px;">
            <button type="submit" class="submit-btn">Submit Attendance</button>
          </div>
        </form>
      @endif
    </div>

  </div>
@endsection