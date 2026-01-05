<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function show(Enrollment $enrollment) {
        if($enrollment->user_id !== Auth::id()) {
            abort(403);
        }

        return view('certificate.view', compact('enrollment'));
    }

    public function download(Enrollment $enrollment) {
        if ($enrollment->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
