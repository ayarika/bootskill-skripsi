<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'type',
        'link',
        'is_read',
        'title',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
