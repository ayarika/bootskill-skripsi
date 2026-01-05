<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'priority',
        'meeting_link',
        'is_from_event',
    ];

    protected $casts = [
        'is_from_event' => 'boolean',
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function syncFromEvent() {
        if ($this->is_from_event && $this->event) {
            $this->title = $this->event->title;
            $this->description = $this->event->description;
            $this->start_datetime = $this->event->start_datetime;
            $this->end_datetime = $this->event->end_datetime;
            $this->meeting_link = $this->event->meeting_link;
        }

        return $this;
    }
}
