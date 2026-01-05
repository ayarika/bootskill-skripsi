<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{User, Bootcamp, Notification};
use Carbon\Carbon;
use DB;

class SendBootcampReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-bootcamp-reminders';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $now = $now->copy()->addHour();

        $events = DB::table('events_table')
        ->whereBetween('start_time', [$now, $soon])
        ->get();

        foreach($events as $event) {
            $participants = DB::table('enrolls')
            ->where('bootcamp_id', $event->bootcamp_id)
            ->get();

            foreach($participants as $user) {
                Notification::create([
                    'user_id' => $user->user_id,
                    'bootcamp_id' => $event->bootcamp_id,
                    'message' => 'Jadwal meeting akan dimulai pukul' . Carbon::parse($event->start_time)->format('H:i'),
                    'type' => 'meeting_reminder'
                ]);
            }
        }

        $this->info('Reminder berhasil dikirim.');
    }
}
