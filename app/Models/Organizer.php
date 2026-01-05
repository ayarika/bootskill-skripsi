<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organizer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'logo_path', 'social_media', 'description'];
    
    public function bootcamps()
    {
        return $this->hasMany(Bootcamp::class);
    }
}