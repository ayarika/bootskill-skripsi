<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    ProfileController,
    LoginController,
    RegisterController,
    BootcampController,
    EnrollController,
    FavoriteController,
    CourseController,
    OrganizerController,
    ScheduleController,
    OrganizerEventController,
    EventController,
    ContactController,
    NotificationController,
    CertificateController,
};

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (No Auth)
|--------------------------------------------------------------------------
*/

// Landing and Info Pages
Route::view('/', 'landinghome')->name('landing');
Route::view('/landinghome', 'landinghome');
Route::view('/aboutlan', 'aboutlan');
Route::view('/partnershiplan', 'partnershiplan');

// Contact Us
    Route::view('/contactuslan', 'contactuslan')->name('contactus.public');
    Route::post('/contactuslan', [ContactController::class, 'submitPublic'])->name('contactus.public.submit');

Route::middleware('auth')->group(function () {
    Route::view('/contactus', 'contactus')->name('contactus.auth');
    Route::post('/contactus', [ContactController::class, 'submitAuth'])->name('contactus.auth.submit');
});

Route::view('/helpandsupport', 'helpandsupport');

// Authentication Pages

// Register
Route::view('/signuplan', 'signuplan');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Login
Route::get('/signinlan', [LoginController::class, 'showLoginForm'])->name('signinlan');
Route::post('/signinlan', [LoginController::class, 'login'])->name('signinlan.attempt');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Change Account
Route::get('/changeaccount', [LoginController::class, 'showChangeAccountForm'])->name('changeaccount.form');
Route::post('/changeaccount', [LoginController::class, 'changeAccount'])->name('changeaccount.login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Reset Password
Route::get('/resetpass', fn() => view('forgotpasslan'))->name('forgotpasslan');
Route::post('/resetpass', [LoginController::class, 'resetpass'])->name('newpass');

// Event public detail
Route::get('/event/{id}', [OrganizerController::class, 'showPublicEvent'])->name('event.public.show');

// Public Organizer Profile
Route::get('/organizer/{id}/profile', [OrganizerController::class, 'showById'])->name('organizer.profile');
Route::get('/search', [SearchController::class, 'index'])->name('search');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/switch-role', [ProfileController::class, 'switchRole'])->name('switch.role');

    Route::post('/change-password', [LoginController::class, 'changePassword'])->name('password.change');

    //Delete participant account
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/settings', function () {
        $user = Auth::user();
        return $user->role === 'Organizer'
            ? redirect()->route('organizer.editprofile')
            : view('settings', ['user' => $user]);
    })->name('settings');

    /*
    |----------------------------------------------------------------------
    | PARTICIPANT ROUTES
    |----------------------------------------------------------------------
    */
    Route::get('/aamainhome', [OrganizerController::class, 'allEvents'])->name('aamainhome');
    Route::get('/search', [BootcampController::class, 'search'])->name('search.bootcamp');    

    // Enroll
    Route::get('/bootcamp/{id}/enroll', [EnrollController::class, 'create']);
    Route::post('/enroll', [EnrollController::class, 'store'])->name('enroll.store');
    Route::get('/bootcamp/{id}', [BootcampController::class, 'show'])->name('bootcamp.detail');
    Route::delete('/enroll/{event}', [EnrollController::class, 'cancel'])->name('enroll.cancel');

    // Courses
    Route::get('/aayourcourse', [CourseController::class, 'index'])->name('your.course');
    Route::get('/yourcourse/{id}', [EnrollController::class, 'showDetail'])->name('yourcourse.detail');

    Route::get(
    '/participant/payment-proof/{enrollment}', [EnrollController::class, 'showPaymentProofParticipant'])->name('participant.paymentproof.show');

    Route::get('/get-started/{enroll}', [EnrollController::class, 'getStarted'])
        ->name('participant.getstarted');

    Route::post('/attendance/{enroll}', [EnrollController::class, 'markAttendance']);

    // Notifications
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllasRead'])
        ->middleware('auth');

    Route::middleware('auth')->get('/notifications/unread-count', function () {
        $user = auth()->user();
        $notifications = \App\Models\Notification::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
        $unreadCount = $notifications->where('is_read', false)->count();

        return response()->json([
            'unreadCount' => $unreadCount,
            'notifications' => $notifications->map(function($n){
                return [
                    'id' => $n->id,
                    'title' => $n->title,
                    'message' => $n->message,
                    'link' => $n->link,
                    'is_read' => $n->is_read,
                    'created_at_human' => $n->created_at->diffForHumans(),
                ];
            }),
        ]);
    });

    Route::middleware('auth')->get('/storage/materials/{path}', function ($path) {
        $fullPath = storage_path('app/public/materials/' . $path);

        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath);
    })->where('path', '.*');
        
    Route::get('/enroll/{id}/detail', [EnrollController::class, 'showDetail'])->name('enroll.detail');
    Route::post('/yourcourse/{enroll}/update-progress', [EnrollController::class, 'updateMaterialProgress'])
        ->name('yourcourse.updateMaterialProgress');

    Route::middleware(['auth'])->group(function() {
        Route::get('/certificate/{enrollment}', [CertificateController::class, 'show'])
            ->name('certificate.view');
        Route::get('/certificate/{enrollment}/download', [CertificateController::class, 'download'])
            ->name('certificate.download');
    });

    // Favorite Organizers
    Route::get('/aafavorite', [FavoriteController::class, 'index'])->name('favorite.list');
    Route::post('/organizer/{id}/favorite', [OrganizerController::class, 'togglefavorite'])->name('organizer.favorite');

    // My Schedule
    Route::prefix('aamyschedule')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('myschedule');
        Route::post('/store', [ScheduleController::class, 'store'])->name('myschedule.store');
        Route::get('/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
        Route::put('/update/{id}', [ScheduleController::class, 'update'])->name("myschedule.update");
        Route::delete('/delete/{id}', [ScheduleController::class, 'destroy'])->name('myschedule.destroy');
    });

    // Profile & Notifications Settings (Participants only)
    Route::prefix('settings')->group(function () {
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.uploadPhoto');
        Route::delete('/profile/delete-picture', [ProfileController::class, 'deleteProfilePicture'])->name('profile.delete_picture');
        Route::put('/notifications', [ProfileController::class, 'updateNotifications'])->name('settings.notifications.update');
        Route::put('/notification/update', [ProfileController::class, 'updateNotifications'])->name('notification.update');
    });

    // About
    Route::get('/aaabout', function() {
        return view('aaabout');
    });

    //How to use boot skill
    Route::get('/aahowtousebootskill', function () {
        return view('howtousebootskill');
    });

    // Switch Account
    Route::get('/switchaccount', [LoginController::class, 'showChangeAccountForm'])->name('switchaccount.form');
    Route::post('/switchaccount', [LoginController::class, 'changeAccount'])->name('changeaccount.login');
    
    // Ganti Bahasa
    Route::get('/locale/{lang}', function ($lang) {
            session(['locale' => $lang]);
            return back();
    })->name('setLocale');
    
    Route::post('/refresh-session', function () {
        session()->put('last_active', now());
        return response()->json(['status' => 'refreshed']);
    });

    Route::get('/profile/devices', [UserController::class, 'showActiveDevices'])->name('profile.devices');
    Route::delete('/profile/devices/{id}', [UserController::class, 'logoutDeviceById'])->name('profile.device.logout');

    Route::view('/signupacc', 'signupacc')->name('signupacc');

    /*
    |----------------------------------------------------------------------
    | ORGANIZER ROUTES
    |----------------------------------------------------------------------
    */

    Route::prefix('organizer')->middleware(['auth', 'organizer'])->group(function () {
        Route::get('/home', [OrganizerController::class, 'home'])->name('organizer.home');

        // Dashboard & Profile
        Route::get('/edit-profile', [OrganizerController::class, 'editProfile'])->name('organizer.editprofile');
        Route::post('/update-profile', [OrganizerController::class, 'updateProfile'])->name('organizer.updateprofile');

        // Event Management
        Route::get('/your-event', [OrganizerController::class, 'yourEvent'])->name('organizer.yourevent');
        Route::get('/create-event', [OrganizerController::class, 'create'])->name('organizer.createevent');
        Route::post('/organizer/event', [OrganizerController::class, 'store'])->name('organizer.event.store');

        Route::post('/events/store', [OrganizerController::class, 'store'])->name('organizer.event.store');
        Route::delete('/event/{id}/delete', [OrganizerController::class, 'deleteEvent'])->name('organizer.deleteevent');
        Route::get('/events/{id}/edit', [OrganizerController::class, 'editEvent'])->name('organizer.editevent');
        Route::put('/events/{id}/update', [OrganizerController::class, 'updateEvent'])->name('organizer.updateevent');

        // Transaction and Attendance
        Route::get('/event/{event}/transactionattendance', [OrganizerController::class, 'transactionAttendance'])->name('organizer.transactionattendance');
        Route::get('/event/{event}/export', [OrganizerController::class, 'export'])->name('organizer.export');
        Route::get('/event/{id}/export-enrollment', [OrganizerController::class, 'exportEnrollment'])->name('organizer.exportEnrollment');

        // Delete Account
        Route::delete('/delete-account', [OrganizerController::class, 'deleteAccount'])->name('organizer.deleteAccount');
        // Help
        Route::get('/help', function () {
            return view('organizer.help');
        })->name('organizer.help');

        Route::get('/payment-proof/{enroll}', function (\App\Models\Enrollment $enroll) {
            $path = storage_path('app/public/' . $enroll->payment_proof);

            if (!file_exists($path)) {
                abort(404, 'File not found');
            }

            return response()->file($path);
        })->name('organizer.paymentproof.show');
    });
});




