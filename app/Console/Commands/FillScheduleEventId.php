<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FillScheduleEventId extends Command
{
   protected $signature = 'fill:schedule-event';
   protected $description = 'Fill event_id in schedules table from enrollments';

   public function handle() {
        $schedules = DB::table('schedules')
            ->whereNull('event_id')
            ->where('is_from_event', true)
            ->get();

        $count = 0;

        foreach ($schedules as $schedule) {
            $enrollment = DB::table('enrollments')
                ->where('user_id', $schedule->user_id)
                ->orderBy('created_at', 'desc')
                ->first();
            
            if ($enrollment) {
                DB::table('schedules')
                    ->where('id', $schedule->id)
                    ->update(['event_id' => $enrollment->bootcamp_id]);
                $count++;
            }
        }

        $this->info("Selesai! $count baris schedules berhasil diupdate.");

        return 0;
   }
}
