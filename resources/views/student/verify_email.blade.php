@extends('student.layout')

@section('title', 'Verify Email')

@section('content')
<div style="display:flex; align-items:center; justify-content:center; min-height:60vh;">
    <div style="background:#fff; border:1px solid #e8ede9; border-radius:12px; padding:40px; max-width:460px; width:100%; text-align:center; box-shadow:0 1px 4px rgba(0,0,0,0.05);">

        <div style="width:64px; height:64px; background:#e8f5e9; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
            <i class="fa fa-envelope" style="font-size:26px; color:#025628;"></i>
        </div>

        <h2 style="font-size:18px; font-weight:700; color:#025628; margin-bottom:10px;">Verify your email</h2>
        <p style="font-size:13px; color:#aaa; line-height:1.7; margin-bottom:24px;">
            Thanks for signing up! Please check your email and click the verification link to activate your account.
        </p>

        @if(session('status') === 'verification-link-sent')
            <div style="background:#e8f5e9; color:#025628; border:1px solid #a5d6a7; border-radius:8px; padding:10px 14px; font-size:13px; margin-bottom:16px;">
                <i class="fa fa-check-circle"></i> A new verification link has been sent to your email.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                style="background:#025628; color:#fff; border:none; border-radius:8px; padding:10px 24px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit; width:100%; margin-bottom:12px;">
                Resend verification email
            </button>
        </form>

        <form method="POST" action="{{ route('Logout') }}">
            @csrf
            <button type="submit"
                style="background:transparent; color:#aaa; border:none; font-size:13px; cursor:pointer; font-family:inherit;">
                Log out
            </button>
        </form>

    </div>
</div>
@endsection