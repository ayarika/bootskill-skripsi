<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(){
        $schedules = Schedule::with([
                'event',
                'event.enrollments' => function ($q) {
                    $q->where('user_id', auth()->id());
                }
            ])
            ->where('user_id', auth()->id())
            ->where(function ($q) {
                    $q->where(function($qq) {
                        $qq->whereNull('is_from_event')
                            ->orWhere('is_from_event', false);
                    })
                    ->orWhere(function ($q2) {
                        $q2->where('is_from_event', true)
                            ->whereNotNull('event_id');
                    });
                
            })
            ->orderBy('start_datetime')
            ->get()
            ->map(function ($schedule) {
                if ($schedule->is_from_event && $schedule->event) {
                    $enroll = $schedule->event->enrollments->first();
                    $schedule->enrollment_id = $enroll?->id;
                } else {
                    $schedule->enrollment_id = null;
                }
                return $schedule;
            });

        return view('participant.myschedule', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after_or_equal:start_datetime',
            'priority' => 'required|in:urgent_important,urgent_not_important,important_not_urgent,not_urgent_not_important',
            'meeting_link' => 'nullable|url',
            'schedule_id' => 'nullable|exists:schedules,id'
        ]);

        $data = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'priority' => $request->priority,
            'meeting_link' => $request->meeting_link ?? '',
            'is_from_event' => false,
        ];

        if ($request->filled('schedule_id')) {
            $schedule = Schedule::where('id', $request->schedule_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($schedule->is_from_event) {
                return back()->with('error', 'Bootcamp schedule cannot be edited.');
            }

            $schedule->update($data);

            return redirect()->back()
                ->with('success', 'Schedule updated!')
                ->with('highlight_schedule', $schedule->id);
        }

        Schedule::create($data);

        return redirect()->route('myschedule')
            ->with('success', 'Schedule added!');
    }

    public function edit(Request $request)
    {
        $date = $request->input('date');

        $query = Schedule::with('event')
            ->where('user_id', Auth::id());

        if ($date) {
            $query->whereDate('start_datetime', '<=', $date)
                    ->whereDate('end_datetime', '>=', $date);
        }

        $schedules = $query->orderBy('start_datetime')->get()
            ->map(fn ($schedule) => $schedule->syncFromEvent());

        return view('participant.editschedule', compact('schedules', 'date'));
    }

    public function destroy($id)
    {
        $schedule = Schedule::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($schedule->is_from_event) {
            return back()->with('error', 'Event schedule cannot be deleted.');
        }

        $schedule->delete();

        return redirect()->route('myschedule')->with('success', 'Schedule deleted.');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable | string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after_or_equal:start_datetime',
            'priority' => 'required|in:urgent_important,urgent_not_important,important_not_urgent,not_urgent_not_important',
            'meeting_link' => 'nullable|url',
        ]);

        $schedule = Schedule::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
            if ($schedule->is_from_event) {
                return back()->with('error', 'Bootcamp schedule cannot be edited.');
            }

            $schedule->update([
                'title' => $request->title,
                'description' => $request->description,
                'start_datetime' => $request->start_datetime,
                'end_datetime' => $request->end_datetime,
                'priority' => $request->priority,
                'meeting_link' => $request->meeting_link ?? '',
            ]);

            return redirect()->route('myschedule')
                ->with('success', 'Schedule updated!');
    }
}
