<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'bootcamp_id',
        'user_id',
        'email',
        'payment_proof',
        'attendance_timestamp',
    ];

    public function bootcamp(){
        return $this->belongsTo(Event::class, 'bootcamp_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event() {
        return $this->bootcamp();

        return $this->belongsTo(Event::class);
    }

    public function materialProgress() {
        return $this->hasMany(MaterialProgress::class, 'enroll_id');
    }

    public function getProgressAttribute() {
        if (!$this->relationLoaded('event')) {
            $this->load('event.materials');
        }

        $total = $this->event->materials->count();

        if($total === 0) return 0;

        $completed = $this->materialProgress()
            ->where('completed', true)
            ->count();
        return round(($completed / $total) * 100);
    }
}
