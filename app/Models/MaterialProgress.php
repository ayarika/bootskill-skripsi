<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialProgress extends Model
{
    use HasFactory;

    protected $table = 'material_progress';

    protected $fillable = [
        'enroll_id',
        'material_key',
        'completed',
    ];

    public function enrollment() {
        return $this->belongsTo(Enrollment::class, 'enroll_id');
    }
}
