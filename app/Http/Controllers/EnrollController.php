<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Enrollment;
use App\Models\Event;
use App\Models\MaterialProgress;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Notification;

class EnrollController extends Controller {
    public function create($id) {
        $event = Event::findOrFail($id);
        return view ('enroll', compact('event'));
    }

    public function store(Request $request) {
        $request->validate([
            'bootcamp_id' => 'required|exists:events,id',
            'email' => 'required|email',
        ]);

        $bootcamp = Event::findOrFail($request->bootcamp_id);

        if($bootcamp->price > 0) {
            $request->validate([
                'payment_proof' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);
            
            $path = $request->hasFile('payment_proof')
                ? $request->file('payment_proof')->store('payment_proofs', 'public')
                : null;
            
            if (!$path) {
                return back()->with('error', 'Proof of payment must be uploaded.');
            }
        } else {
            $path = null;
        }

        $enrollment = Enrollment::create([
            'bootcamp_id' => $request->bootcamp_id,
            'user_id' => Auth::id(),
            'email' => $request->email,
            'payment_proof' => $path,
        ]);

        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'enroll',
            'title' => 'Enrollment Successful',
            'message' => 'You have enrolled in"' .$bootcamp->title . '"',
            'link' => route('bootcamp.detail', $bootcamp->id),
        ]);

        $start = Carbon::parse($bootcamp->start_date);
        $now = now();

        $priority = $start->isPast() || $start->diffInDays($now) <= 3
            ? 'urgent_important'
            : 'important_not_urgent';

        $schedule = Schedule::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'event_id' => $bootcamp->id,
            ],
            [
                'title' => $bootcamp->title,
                'description' => $bootcamp->description,
                'start_datetime' => Carbon::parse($bootcamp->start_date),
                'end_datetime'   => Carbon::parse($bootcamp->end_date),
                'meeting_link' => $bootcamp->meeting_link,
                'priority' =>  $priority,
                'is_from_event' => true,
        ]);

        $daysDiff = Carbon::parse($bootcamp->start_date)->diffInDays(now(), false);

        if ($daysDiff === 0 || $daysDiff === 1) {
            Notification::create([
                'user_id' => Auth::id(),
                'type' => 'schedule',
                'title' => 'Upcoming Schedule',
                'message' => $daysDiff === 0
                    ? 'Your event "' . $bootcamp->title . '" starts today'
                    : 'Your event "' . $bootcamp->title . '" starts tomorrow',
                'link' => route('aamyschedule'),
            ]);
        }

        return redirect()->route('your.course')->with('success', 'Successfully registered for bootcamp!');
    }

    public function yourCourses() {
        
        $userId = Auth::id();

        $enrollments = Enrollment::with([
            'event.materials',
            'event.organizer',
            'materialProgress'
        ])
        ->where('user_id', $userId)
        ->get();

        $enrollments->each(function ($enroll) {
            $totalMaterials = $enroll->event->materials->count();

            $completedCount = $enroll->materialProgress
                ->where('completed', true)
                ->count();
            
            $enroll->progress = $totalMaterials > 0
                ? round(($completedCount / $totalMaterials) * 100)
                : 0;
        });

        return view('aayourcourse', compact('enrollments'));
    }

    public function showDetail($id) {
        $enroll = Enrollment::with(['event.materials'])->findOrFail($id);
        $event = $enroll->event;

        $now = \Carbon\Carbon::now();
        $meetingActive = $event && $event->start_time && $event->end_time
            ? $now->between(\Carbon\Carbon::parse($event->start_time), \Carbon\Carbon::parse($event->end_time))
            : false;

        $materialProgress = $enroll->materialProgress()
            ->where('completed', true)
            ->pluck('material_key')
            ->toArray();
        
        $totalMaterials = $event->materials->count();
        $completedCount = count($materialProgress);
        $progress = $totalMaterials > 0 ? round(($completedCount / $totalMaterials) * 100) : 0;

        return view('yourcourse.detail', compact(
            'enroll', 'event', 'meetingActive', 'progress',
            'materialProgress', 'totalMaterials'
        ));
    }



    public function updateMaterialProgress(Request $request, $enrollId) {
        $request->validate([
            'material_key' => 'required|string',
            'completed' => 'required|boolean',
        ]);

        $enroll = Enrollment::findOrFail($enrollId);

            if($request->material_key === 'all') {
                $keys = $enroll->event->materials->pluck('key')->toArray();
                foreach($keys as $key) {
                    MaterialProgress::updateOrCreate(
                        ['enroll_id' => $enroll->id,'material_key' => $key],
                        ['completed' => $request->completed]
                    );
                }   
            } else {
                MaterialProgress::updateOrCreate(
                    ['enroll_id' => $enroll->id, 'material_key' => $request->material_key],
                    ['completed' => $request->completed]
                );
            }

            $completedKeys = MaterialProgress::where('enroll_id', $enroll->id)
                ->where('completed', true)
                ->pluck('material_key')
                ->toArray();

            $totalMaterials = $enroll->event->materials->count();
            $completedCount = count($completedKeys);
            $progress = $totalMaterials > 0 ? round(($completedCount / $totalMaterials) * 100) : 0;

            return response()->json([
                'success' => true,
                'completedKeys' => $completedKeys,
                'completedCount' => $completedCount,
                'totalMaterials' => $totalMaterials,
                'progress' => $progress
            ]);
    }

    public function showCertificate($id) {
        $enrollment = Enrollment::with(['event', 'user'])->findOrFail($id);

        return view('certificate.show', compact('enrollment'));
    }

    public function getStarted(Enrollment $enroll) {
        if ($enroll->user_id !== Auth::id()) {
            abort(403);
        }

        $enroll->load([
            'event.materials'
        ]);

        $event = $enroll->event;

        $completedKeys = $enroll->materialProgress()
            ->where('completed', true)
            ->pluck('material_key')
            ->toArray();

        $totalMaterials = $event->materials->count();
        $completedCount = count($completedKeys);
        $progress = $totalMaterials > 0
            ? round(($completedCount / $totalMaterials) * 100)
            : 0;
        
            $now = Carbon::now();
            $meetingActive = $event->start_time && $event->end_time
                ? $now->between(
                    Carbon::parse($event->start_time),
                    Carbon::parse($event->end_time)
                )
                : false;

        return view('participant.getstarted', compact(
            'enroll', 
            'event',
            'completedKeys',
            'progress',
            'meetingActive',
            'totalMaterials'
        ));
    }

    public function cancel($eventId) {
        $enrollment = Enrollment::where('bootcamp_id', $eventId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($enrollment->event->price > 0) {
            abort(403);
        }

        Schedule::where('user_id', auth()->id())
            ->where(function($q) use ($eventId) {
                $q->where('event_id', $eventId)
                    ->orWhereNull('event_id');
            })
            ->delete();

        Notification::create([
            'user_id' => auth()->id(),
            'type' => 'cancel',
            'title' => 'Enrollment Canceled',
            'message' => 'You canceled enrollment for "' . $enrollment->event->title . '"',
            'link' => route('aamainhome'),
        ]);
        $enrollment->delete();

        return back()->with('unenroll_success', 'You have successfully unenrolled from this bootcamp.');
    }

    public function markAttendance(Enrollment $enroll) {
        $user = auth()->user();

        if ($enroll->user_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $enroll->attendance_timestamp = now();
        $enroll->save();

        return response()->json(['success' => true, 'timestamp' => $enroll->attendance_timestamp]);
    }

    public function showPaymentProofParticipant(Enrollment $enrollment) {
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$enrollment->payment_proof) {
            abort(404);
        }

        $path = storage_path('app/public/' . $enrollment->payment_proof);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}