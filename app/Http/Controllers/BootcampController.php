<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;

class BootcampController extends Controller
{
     public function index() {
        $events = Event::where('end_date', '>=', now())
                    ->orderBy('start_date', 'asc')
                    ->with('organizer')
                    ->get();
        return view('aamainhome', compact('events'));
    }

    public function show($id)
    {
        $event = Event::with('organizer')
            ->where('status', 'published')
            ->findOrFail($id);

        $isEnrolled = false;

        if (Auth::check()) {
            $isEnrolled = Enrollment::where('user_id', Auth::id())
                ->where('bootcamp_id', $event->id)
                ->exists();
        }

        return view('bootcampdetail', compact('event', 'isEnrolled'));
    }

    public function search(Request $request) {
        $query = $request->input('query');

        $results = Event::with('organizer')
            ->where('status', 'published')
            ->whereDate('end_date', '>=', now())
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->orderBy('start_date', 'asc')
            ->get();
            
        $organizer = User::whereIn('role', ['Organizer', 'organizer_active'])
                            ->where('name', 'like', '%' . $query . '%')
                            ->get();

        return view('searchresults', compact('results', 'organizer', 'query'));
    }
}
