<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        
        $userId = auth()->id();

        $favorites = \App\Models\Favorite::with('organizer')
                    ->where('user_id', $userId)
                    ->get();

        return view('aafavorite', compact('favorites'));
    }
}
