<?php

namespace App\Http\Middleware;

use App\Models\Registration;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('Login');
        }

        if (Auth::user()->role !== 'student') {
            return redirect()->route('Login');
        }

        // Allow students to access the registration process.
        if ($request->routeIs(
            'registration.step1',
            'registration.step1.save',
            'registration.step2',
            'registration.step2.show',
            'registration.submit'
        )) {
            return $next($request);
        }

        // Require students to complete registration before accessing
        // student pages.
        $hasRegistration = Registration::where(
            'user_id',
            Auth::id()
        )->exists();

        if (!$hasRegistration) {
            return redirect()->route('registration.step1');
        }

        return $next($request);
    }
}