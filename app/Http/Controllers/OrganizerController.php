<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Organizer;
use App\Models\Favorite;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Event;
use App\Exports\EnrollmentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Bootcamp;
use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Support\Str;
use App\Models\Schedule;

class OrganizerController extends Controller
{
    public function showById($id, Request $request) {
        $organizer = User::with('events')->findOrFail($id);
        
        $bootcampId = $request->query('bootcamp_id');

        $isFavorited = false;
        if (Auth::check()) {
            $isFavorited = Favorite::where('user_id', Auth::id())
                ->where('organizer_id', $id)
                ->exists();
        }

        return view('organizerprofile', compact('organizer', 'isFavorited', 'bootcampId'));
    }

    public function create() {
        $topics = Event::selectRaw('LOWER(topic) as normalized')
            ->whereNotNull('topic')
            ->distinct()
            ->pluck('normalized')
            ->map(fn($t) => ucwords($t))
            ->sort()
            ->values();
        
        $categories = Event::selectRaw('LOWER(category) as normalized')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('normalized')
            ->map(fn($c) => ucwords($c))
            ->sort()
            ->values();
        
        $event = null;
        $startDateValue = old('start_date', now()->format('Y-m-d\TH:i'));
        $endDateValue = old('end_date', now()->addHour()->format('Y-m-d\TH:i'));

        return view('organizer.createevent', compact('topics', 'categories', 'event', 'startDateValue', 'endDateValue'));
    }

    public function toggleFavorite(Request $request, $id) {
        $userId = Auth::id();
        $organizer = User::findOrFail($id);

        $favorite = Favorite::where('user_id', $userId)->where('organizer_id', $id)->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => $userId,
                'organizer_id' => $id,
            ]);
        }

        return redirect($request->return_to ?? url()->previous());

    }

    public function home() {
        $user = auth()->user(); 
        $events = $user->events ?? [];

        return view('organizer.home', compact('user', 'events'));
    }


    public function show($id) {
        $user = User::findOrFail($id);
        return view('organizer.show', compact('user'));
    }


    public function editProfile() {
        $user = Auth::user();
        return view('organizer.editprofile', compact('user'));
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'social_link' => 'nullable|url',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        if ($request->remove_photo == "1") {
            if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
                unlink(public_path($user->profile_picture));
            }
            $user->profile_picture = null;
        }

        if ($request->hasFile('profile_picture')) {

            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->profile_picture = $request
                ->file('profile_picture')
                ->store('profile_pictures', 'public');
        }

        $user->name = $request->name;
        $user->description = $request->description;
        $user->social_link = $request->social_link;
        $user->save();

        if ($user->role === 'student') {
            return redirect()->route('aamainhome');
        }

        return redirect()->route('organizer.home')->with('success', 'Profile updated successfully.');
    }
    
    protected function determineRedirect($user) {
        return $user->role === 'student'
            ? redirect('/aamainhome')
            : redirect()->route('organizer.home');
    }

    protected function noCacheHeaders()
    {
        return [
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];
    }

    public function settings() {
        return view('organizer.editprofile');
    }

    public function yourEvent() {
        $events = Event::where('organizer_id', auth()->id())->get();
        return view('organizer.yourevent', compact('events'));
    }

    public function transaction(Request $request) {
        $eventId = $request->query('event_id');

        if (!$eventId) {
            return redirect()->back()->with('error', 'Event ID not found');
        }

        $event = Event::with(['filteredEnrolls.user'])->find($eventId);

        if (!$event) {
            return redirect()->back()->with('error', 'Event not found');
        }

        return view('organizer.transactionattendance', compact('event'));
    }


   public function store(Request $request) {
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'evaluation_test_url' => 'nullable|url|max:255',
            'group_url' => 'nullable|url',
            'price' => 'nullable|numeric|min:0',
            'evaluation_event_url' => 'nullable|url',
            'meeting_link' => 'nullable|url',
            'status' => 'required|in:published,draft',
            'topic' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'quota' => 'nullable|integer|min:1',
        ]);

        foreach ($request->materials ?? [] as $key => $material) {
            if (($material['type'] ?? null) === 'video_link') {
                if (!empty($material['link']) &&
                    !filter_var($material['link'], FILTER_VALIDATE_URL)) {
                        throw \Illuminate\Validation\ValidationException::withMessages([
                            "materials.$key.link" => 'Video link must be a valid URL',
                        ]);
                    }
            }
        }

        if ($request->hasFile('event_image')) {
            $validated['image_path'] = $this->uploadToPublic($request->file('event_image'), 'event_images');
        }

        $validated['organizer_id'] = Auth::id();

        if(!empty($validated['topic'])) {
            $validated['topic'] = ucwords(strtolower(trim($validated['topic'])));
        }

        if (!empty($validated['category'])) {
            $validated['category'] = ucwords(strtolower(trim($validated['category'])));
        }

        $event = Event::create($validated);

        if ($event->status === 'published') {
            $favoritedUsers = Favorite::where('organizer_id', Auth::id())
                ->pluck('user_id');

            foreach ($favoritedUsers as $userId) {
                Notification::create([
                    'user_id' => $userId,
                    'bootcamp_id' => $event->id,
                    'title' => 'New Event Published',
                    'message' => Auth::user()->name . ' published a new event: "' . $event->title . '"',
                    'type' => 'organizer_event',
                    'link' => route('bootcamp.detail', $event->id),
                ]);
            }
        }

        if ($request->has('materials')) {
            foreach ($request->materials as $materialData) {
                if (empty($materialData['title'])) {
                    continue;
                }

                $type = $materialData['type'] ?? 'pdf';
                $filePath = null;
                $videoLink = null;

                if ($type === 'video_link') {
                    $videoLink = $materialData['video_link'] ?? null;
                }
                elseif (
                    isset($materialData['file']) &&
                    $materialData['file'] instanceof \Illuminate\Http\UploadedFile
                 ) {
                    $filePath = $this->uploadToPublic($materialData['file'], 'materials');
                }

                \App\Models\Material::create([
                    'event_id' => $event->id,
                    'title' => $materialData['title'],
                    'type' => $type,
                    'file_path' => $filePath,
                    'video_link' => $videoLink,
                    'key' => Str::uuid(),
                ]);
            }
        }
 
        return redirect()->route('organizer.yourevent')->with('success', 'Event saved successfully!');
    }

    public function editEvent($id) {
        $event = Event::with('materials')->withCount('enrollments')->findOrFail($id);
        $materials =  $event->materials;

        $topics = Event::selectRaw('LOWER(topic) as normalized')
            ->whereNotNull('topic')
            ->distinct()
            ->pluck('normalized')
            ->map(fn($t) => ucwords($t))
            ->sort()
            ->values();

        $categories = Event::selectRaw('LOWER(category) as normalized')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('normalized')
            ->map(fn($c) => ucwords($c))
            ->sort()
            ->values();

        $startDateValue = old('start_date', \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i'));
        $endDateValue = old('end_date', \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i'));

        return view('organizer.editevent', compact('event', 'materials', 'topics', 'categories', 'startDateValue', 'endDateValue'));
    }

    public function deleteEvent($id) {
        $event = Event::findOrFail($id);

        if ($event->organizer_id !== auth()->id()) {
            abort(403);
        }

        if ($event->image_path && file_exists(public_path($event->image_path))) {
            unlink(public_path($event->image_path));
        }

        foreach ($event->materials as $material) {
            if ($material->file_path && file_exists(public_path($material->file_path))) {
                unlink(public_path($material->file_path));
            }
            $material->delete();
        }

        $event->delete();

        return redirect()->route('organizer.yourevent')->with('success', 'Event deleted successfully.');
    }


    public function updateEvent(Request $request, $id) {
        
        $event = Event::findOrFail($id);

        if ($event->organizer_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'evaluation_test_url' => 'nullable|url',
            'group_url' => 'nullable|url',
            'price' => 'nullable|numeric|min:0',
            'evaluation_event_url' => 'nullable|url',
            'meeting_link' => 'nullable|url',
            'event_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'topic' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'quota' => 'nullable|integer|min:1',
            'is_almost_full' => 'nullable|boolean',
            'is_full' => 'nullable|boolean',
            'certificate_path' => 'nullable|url',
        ]);

        foreach ($request->materials ?? [] as $key => $material) {
            if (($material['type'] ?? null) === 'video_link') {
                if (!empty($material['video_link']) &&
                    !filter_var($material['video_link'], FILTER_VALIDATE_URL)) {

                        throw \Illuminate\Validation\ValidationException::withMessages([
                            "materials.$key.video_link" => 'Video link must be a valid URL',
                        ]);
                }
            }
        }

        unset(
            $validated['evaluation_test_url'],
            $validated['group_url'],
            $validated['price']
        );

        if (!empty($validated['topic'])) {
            $validated['topic'] = ucwords(strtolower(trim($validated['topic'])));
        }
        if (!empty($validated['category'])) {
            $validated['category'] = ucwords(strtolower(trim($validated['category'])));
        }

        $event->fill($validated);

        $event->evaluation_test_url = $request->has('has_evaluation_test')
            ? $request->evaluation_test_url
            : null;
        
        $event->group_url = $request->has('has_group')
            ? $request->group_url
            : null;
        
        $event->price = $request->has('has_paid')
            ? $request->price
            : 0;    

        $event->is_almost_full = $request->has('is_almost_full');
        $event->is_full = $request->has('is_full');

        if($request->hasFile('event_image')) {
            $event->image_path = $this->uploadToPublic($request->file('event_image'), 'event_images');
        }

        $oldStatus = $event->status;

        if ($oldStatus !== 'published' && $event->status === 'published') {

            $favoritedUsers = Favorite::where('organizer_id', auth()->id())
                ->pluck('user_id');

            foreach ($favoritedUsers as $userId) {
                Notification::create([
                    'user_id' => $userId,
                    'bootcamp_id' => $event->id,
                    'title' => 'New Event Published',
                    'message' => auth()->user()->name . ' published a new event: "' . $event->title . '"',
                    'type' => 'organizer_event',
                    'link' => route('bootcamp.detail', $event->id),
                ]);
            }
        }

        $event->save();

        Schedule::where('is_from_event', 1)
            ->where('event_id', $event->id)
            ->update([
                'title' => $event->title,
                'description' => $event->description,
                'start_datetime' => Carbon::parse($event->start_date),
                'end_datetime' => Carbon::parse($event->end_date),
                'meeting_link' => $event->meeting_link,
            ]);

        $removedMaterialIds = $request->input('removed_materials', []);
        
        if (!empty($removedMaterialIds)) {
            foreach ($removedMaterialIds as $materialId) {
                $material = \App\Models\Material::where('id', $materialId)
                    ->where('event_id', $event->id)
                    ->first();
                
                if ($material) {
                    if ($material->file_path && file_exists(public_path($material->file_path))) {
                        unlink(public_path($material->file_path));
                    }
                    $material->delete();
                }
            }
        }

        if ($request->has('materials')) {
            foreach ($request->materials as $key => $materialData) {

                if (in_array((string) $key, $removedMaterialIds, true)) {
                    continue;
                }

                if (is_numeric($key)) {
                    $material = \App\Models\Material::where('id', $key)
                        ->where('event_id', $event->id)
                        ->first();

                    if ($material) {

                        $type = $materialData['type'] ?? $material->type;

                        $filePath = $material->file_path;
                        $videoLink = $material->video_link;

                        if ($type === 'video_link') {
                            $filePath = null;

                            if ($request->filled("materials.$key.video_link")) {
                                $videoLink = $materialData['video_link'];
                            }

                            if ($material->file_path && file_exists(public_path($material->file_path))) {
                                unlink(public_path($material->file_path));
                            }
                        }

                        if (
                            in_array($type, ['pdf', 'video_file']) &&
                            isset($materialData['file']) &&
                            $materialData['file'] instanceof \Illuminate\Http\UploadedFile
                        ) {
                            if ($material->file_path && file_exists(public_path($material->file_path))) {
                                unlink(public_path($material->file_path));
                            }

                            $filePath = $this->uploadToPublic($materialData['file'], 'materials');
                        }

                        $material->update([
                            'title' => $materialData['title'] ?? $material->title,
                            'type' => $type,
                            'file_path' => $filePath,
                            'video_link' => $videoLink,
                        ]);
                    }
                }

                elseif (str_starts_with($key, 'new_')) {
                    if (!empty($materialData['title'])) {
                        $type = $materialData['type'] ?? 'pdf';
                        $filePath = null;
                        $videoLink = null;

                        if ($type === 'video_link') {
                            $videoLink = $materialData['video_link'] ?? null;
                        } elseif (
                            isset($materialData['file']) &&
                            $materialData['file'] instanceof \Illuminate\Http\UploadedFile
                        ) {
                            $filePath = $this->uploadToPublic($materialData['file'], 'materials');
                        }

                        \App\Models\Material::create([
                            'event_id' => $event->id,
                            'title' => $materialData['title'],
                            'type' => $type,
                            'file_path' => $filePath,
                            'video_link' => $videoLink,
                            'key' => Str::uuid(),
                        ]);
                    }
                }
            }
        }
        return redirect()->route('organizer.yourevent')->with('success', 'Event updated successfully!');
    }

    public function showTransactionAttendance(Request $request) {
        $eventId = $request->query('event_id');

        if (!$eventId) {
            return redirect()->back()->with('error', 'Event ID not found.');
        }

        $event = Event::with(['filteredEnrolls.user'])->find($eventId);

        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        return view('organizer.transactionattendance', compact('event'));
    }


    public function exportEnrollment($id)
    {
        $event = Event::with('enrolls.user')->findOrFail($id);
        return Excel::download(new EnrollmentExport($event), 'data-enrollment.xlsx');
    }

    public function transactionAttendance(Event $event) {
        return view('organizer.transactionattendance', [
            'event' => $event
        ]);
    } 

    public function allEvents(Request $request) {

        $userId = Auth::id();

        $query = Event::with('organizer')
            ->where('status', 'published')
            ->whereDate('end_date', '>=', now())
            ->whereDoesntHave('enrollments', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('topic')) {
            $query->where('topic', $request->topic);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $events = $query->get();

        $topics = Event::where('status', 'published')
            ->whereDate('end_date', '>=', now())
            ->select('topic')->distinct()->pluck('topic')->filter();

        $categories = Event::where('status', 'published')
            ->whereDate('end_date', '>=', now())
            ->select('category')->distinct()->pluck('category')->filter();
        
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();
            
        $unreadCount = Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();

        return view('aamainhome', compact('events', 'topics', 'categories', 'notifications', 'unreadCount'));
    }

    public function showPublicEvent($id) {
        $event = Event::with('organizer')->where('status', 'published')->find($id);

        return view('bootcampdetail', compact('event'));
    }

    public function publicProfile($id) {
        $organizer = User::where('id', $id)
            ->where('role', 'Organizer')
            ->firstOrFail();

        return view('organizer.publicprofile', compact('organizer'));
    }

    public function deleteAccount(Request $request) {
        $user = Auth::user();

        if (!in_array($user->role, ['organizer_active', 'Organizer'])) {
            abort(403, 'Unauthorized action.');
        }

        $events = Event::where('organizer_id', $user->id)->get();
        foreach ($events as $event) {
            if ($event->image_path && file_exists(public_path($event->image_path))) {
                unlink(public_path($event->image_path));
            }

            $event->delete();
        }

        if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
            unlink(public_path($user->profile_picture));
        }

        Auth::logout();

        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }

    private function uploadToPublic($file, $folder) {
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($folder), $fileName);
        return $folder . '/' . $fileName;
    }
}