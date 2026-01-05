<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bootcamp;
use Carbon\Carbon;

class YourCourseController extends Controller
{
    public function index() {
        $user = Auth::user();

        $enrolledBootcamps = Bootcamp::whereHas('enrolls', function($query) use ($user) {
            $query->where('user_id', $user->id)
                ->whereNotNull('payment_proof');
        })
        ->with(['organizer', 'materials'])
        ->get()
        ->map(function ($bootcamp) use ($user) {

            $totalMaterials = $bootcamp->materials->count();

            $completedMaterials = $bootcamp->materials()
                ->whereHas('progress', function ($q) use ($user) {
                    $q->where('user_id'. $user->id)
                        ->where('completed', true);
                })
                ->count();
            $bootcamp->progress = $totalMaterial > 0
                ? round(($completedMaterials / $totalMaterials) * 100)
                : 0;
            return $bootcamp;
        });
        
        return view('aayourcourse', compact('enrolledBootcamps'));
    }

}
