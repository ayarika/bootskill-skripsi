<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enrollment;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'image_path',
        'evaluation_test_url',
        'group_url',
        'price',
        'evaluation_event_url',
        'meeting_link',
        'status',
        'organizer_id',
        'topic',
        'category',
        'quota',
        'certificate_path',
    ];


    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function enrolls() {
        return $this->hasMany(Enrollment::class, 'bootcamp_id');
    }

    public function filteredEnrolls() {
        return $this->hasMany(Enrollment::class, 'event_id', 'id')
            ->whereNotNull('payment_proof');
    }

    public function materials(){
        return $this->hasMany(\App\Models\Material::class);
    }

    public function enrollments() {
        return $this->enrolls();
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }

}
