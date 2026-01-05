<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class OrganizerOnly
{
    public function handle(Request $request, Closure $next): Response {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'organizer_active') {
            abort(403, 'Special Organizer Access');
        }

        return $next($request);
    }
}
