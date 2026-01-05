<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $enrollments = Enrollment::with(['event.organizer'])
            ->where('user_id', $user->id)
            ->get();

        return view('aayourcourse', compact('enrollments'));
    }
}
