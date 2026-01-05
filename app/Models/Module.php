<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'bootcamp_id',
        'title',
        'file_path',
    ];

    public function bootcamp()
    {
        return $this->belongsTo(Bootcamp::class);
    }
}
