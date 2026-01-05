<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MeetingReminderMail;

class Kernel extends ConsoleKernel {

    protected function schedule(Schedule $schedule): void {
        $schedule->command('reminder:bootcamp')->everyMinute();
        $schedule->call(function () {
            $upcomingEvents = DB::table('events')
            ->whereBetween('start_time', [
                now()->addMinutes(55), now()->addMinutes(65)
            ])->get();

            foreach ($upcomingEvents as $event) {
                $enrolledUsers = DB::table('enrolls')
                    ->where('event_id', $event->id)
                    ->join('users', 'users.id', '=', 'enrolls.user_id')
                    ->select('users.email')
                    ->get();

                    foreach ($enrolledUsers as $user) {
                        Mail::to($user->email)->send(new MeetingReminderMail($event));
                    }
            }
        })->everyFiveMinutes();
    }

    protected function commands(): void {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    

}