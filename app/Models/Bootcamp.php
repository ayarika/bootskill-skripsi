<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bootcamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description',
        'image_path',
        'organizer_id',
        'is_paid',
        'price',
        'start_date',
        'end_date',
        'has_evaluation_test',
        'has_group_feature'
    ];
    
    public function organizer(){
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function modules(){
        return $this-> hasMany(Module::class);
    }

    public function enrolls(){
        return $this->hasMany(Enrollment::class);
    }

    public function search(Request $request) {
        $query = $request->input('query');

        $results = Bootcamp::where('title', 'like', '%' . $query . '%')
                   ->orWhere('description', 'like', '%' . $query . '%')
                   ->get();

        return view('searchresults', [
            'query' => $query,
            'results' => $results,
        ]);
    }

    public function event() {
        return $this->hasOne(Event::class);
    }
}

